<?php

use Phalcon\Tag as Tag;
use Phalcon\Mvc\Model\Criteria;

class CompaniesController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Tag::setTitle('Manage your companies');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->session->conditions = null;
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
    }

    public function editAction($id)
    {
        $request = $this->request;
        if (!$request->isPost()) {

            $companies = Companies::findFirst(array('id=:id:', 'bind' => array('id' => $id)));
            if (!$companies) {
                $this->flash->error("companies was not found");
                return $this->forward("companies/index");
            }
            $this->view->setVar("id", $companies->id);

            Tag::displayTo("id", $companies->id);
            Tag::displayTo("name", $companies->name);
            Tag::displayTo("telephone", $companies->telephone);
            Tag::displayTo("address", $companies->address);
            Tag::displayTo("city", $companies->city);
        }
    }

    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("companies/index");
        }

        $companies = new Companies();
        $companies->id = $this->request->getPost("id", "int");
        $companies->name = $this->request->getPost("name", "striptags");
        $companies->telephone = $this->request->getPost("telephone", "striptags");
        $companies->address = $this->request->getPost("address", "striptags");
        $companies->city = $this->request->getPost("city", "striptags");

        if (!$companies->save()) {
            foreach ($companies->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->forward("companies/new");
        } else {
            $this->flash->success("companies was created successfully");
            return $this->forward("companies/index");
        }
    }

    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("companies/index");
        }

        $id = $this->request->getPost("id", "int");
        $companies = Companies::findFirst("id='$id'");
        if ($companies == false) {
            $this->flash->error("companies does not exist ".$id);
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
        } else {
            $this->flash->success("companies was updated successfully");
            return $this->forward("companies/index");
        }
    }

    public function deleteAction($id)
    {

        $companies = Companies::findFirst(array('id=:id:', 'bind' => array('id' => $id)));
        if (!$companies) {
            $this->flash->error("Company was not found");
            return $this->forward("companies/index");
        }

        if (!$companies->delete()) {
            foreach ($companies->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->forward("companies/search");
        } else {
            $this->flash->success("companies was deleted");
            return $this->forward("companies/index");
        }
    }
}
