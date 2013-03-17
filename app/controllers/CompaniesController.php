<?php

use Phalcon\Tag,
	Phalcon\Mvc\Model\Criteria,
	Phalcon\Forms\Form,
	Phalcon\Forms\Element\Text,
	Phalcon\Forms\Element\Hidden;

class CompaniesController extends ControllerBase
{
	public function initialize()
	{
		$this->view->setTemplateAfter('main');
		Tag::setTitle('Manage your companies');
		parent::initialize();
	}

	protected function getForm($entity=null, $edit=false)
	{
		$form = new Form($entity);

		if (!$edit) {
			$form->add(new Text("id", array(
				"size" => 10,
				"maxlength" => 10,
			)));
		} else {
			$form->add(new Hidden("id"));
		}

		$form->add(new Text("name", array(
			"size" => 24,
			"maxlength" => 70
		)));

		$form->add(new Text("telephone", array(
			"size" => 10,
			"maxlength" => 30
		)));

		$form->add(new Text("address", array(
			"size" => 14,
			"maxlength" => 40
		)));

		$form->add(new Text("city", array(
			"size" => 14,
			"maxlength" => 40
		)));

		return $form;
	}

	public function indexAction()
	{
		$this->session->conditions = null;
		$this->view->form = $this->getForm();
	}

	public function searchAction()
	{
		$numberPage = 1;
		if ($this->request->isPost()) {
			$query = Criteria::fromInput($this->di, "Companies", $_POST);
			$this->persistent->searchParams = $query->getParams();
		} else {
			$numberPage = $this->request->getQuery("page", "int");
			if ($numberPage <= 0) {
				$numberPage = 1;
			}
		}

		$parameters = array();
		if ($this->persistent->searchParams) {
			$parameters = $this->persistent->searchParams;
		}

		$companies = Companies::find($parameters);
		if (count($companies) == 0) {
			$this->flash->notice("The search did not find any companies");
			return $this->forward("companies/index");
		}

		$paginator = new Phalcon\Paginator\Adapter\Model(array(
			"data" => $companies,
			"limit" => 10,
			"page" => $numberPage
		));
		$page = $paginator->getPaginate();

		$this->view->setVar("page", $page);
		$this->view->setVar("companies", $companies);
	}

	public function newAction()
	{
		$this->view->form = $this->getForm();
	}

	public function editAction($id)
	{
		$request = $this->request;
		if (!$request->isPost()) {

			$company = Companies::findFirstById($id);
			if (!$company) {
				$this->flash->error("Company was not found");
				return $this->forward("companies/index");
			}

			$this->view->form = $this->getForm($company, true);
		}
	}

	public function createAction()
	{
		if (!$this->request->isPost()) {
			return $this->forward("companies/index");
		}

		$companies = new Companies();
		$companies->name = $this->request->getPost("name", "striptags");
		$companies->telephone = $this->request->getPost("telephone", "striptags");
		$companies->address = $this->request->getPost("address", "striptags");
		$companies->city = $this->request->getPost("city", "striptags");

		if (!$companies->save()) {
			foreach ($companies->getMessages() as $message) {
				$this->flash->error((string) $message);
			}
			return $this->forward("companies/new");
		}

		$this->flash->success("Company was created successfully");
		return $this->forward("companies/index");
	}

	public function saveAction()
	{
		if (!$this->request->isPost()) {
			return $this->forward("companies/index");
		}

		$id = $this->request->getPost("id", "int");

		$companies = Companies::findFirstById($id);
		if ($companies == false) {
			$this->flash->error("Company does not exist ".$id);
			return $this->forward("companies/index");
		}

		$companies->id = $this->request->getPost("id", "int");
		$companies->name = $this->request->getPost("name", "striptags");
		$companies->telephone = $this->request->getPost("telephone", "striptags");
		$companies->address = $this->request->getPost("address", "striptags");
		$companies->city = $this->request->getPost("city", "striptags");

		if (!$companies->save()) {
			foreach ($companies->getMessages() as $message) {
				$this->flash->error((string) $message);
			}
			return $this->forward("companies/edit/".$companies->id);
		}

		$this->flash->success("Company was updated successfully");
		return $this->forward("companies/index");
	}

	public function deleteAction($id)
	{

		$companies = Companies::findFirstById($id);
		if (!$companies) {
			$this->flash->error("Company was not found");
			return $this->forward("companies/index");
		}

		if (!$companies->delete()) {
			foreach ($companies->getMessages() as $message) {
				$this->flash->error((string) $message);
			}
			return $this->forward("companies/search");
		}

		$this->flash->success("Company was deleted");
		return $this->forward("companies/index");
	}
}
