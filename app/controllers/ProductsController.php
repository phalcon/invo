<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ProductsController extends ControllerBase
{
	public function initialize()
	{
		$this->tag->setTitle('Manage your products');
		parent::initialize();
	}

	/**
	 * Shows the index action
	 */
	public function indexAction()
	{
		$this->session->conditions = null;
		$this->view->form = new ProductsForm;
	}

	/**
	 * Search products based on current criteria
	 */
	public function searchAction()
	{
		$numberPage = 1;
		if ($this->request->isPost()) {
			$query = Criteria::fromInput($this->di, "Products", $this->request->getPost());
			$this->persistent->searchParams = $query->getParams();
		} else {
			$numberPage = $this->request->getQuery("page", "int");
		}

		$parameters = array();
		if ($this->persistent->searchParams) {
			$parameters = $this->persistent->searchParams;
		}

		$products = Products::find($parameters);
		if (count($products) == 0) {
			$this->flash->notice("The search did not find any products");
			return $this->forward("products/index");
		}

		$paginator = new Paginator(array(
			"data"  => $products,
			"limit" => 10,
			"page"  => $numberPage
		));

		$this->view->page = $paginator->getPaginate();
		$this->view->products = $products;
	}

	/**
	 * Shows the form to create a new company
	 */
	public function newAction()
	{
		$this->view->form = new ProductsForm(null, array('edit' => true));
	}

	/**
	 * Edits a company based on its id
	 */
	public function editAction($id)
	{

		if (!$this->request->isPost()) {

			$product = Products::findFirstById($id);
			if (!$product) {
				$this->flash->error("Product was not found");
				return $this->forward("products/index");
			}

			$this->view->form = new ProductsForm($product, array('edit' => true));
		}
	}

	/**
	 * Creates a new company
	 */
	public function createAction()
	{
		if (!$this->request->isPost()) {
			return $this->forward("products/index");
		}

		$form = new ProductsForm;
        $product = new Products();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('products/new');
        }

        if ($company->save() == false) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('products/new');
        }

        $form->clear();

		$this->flash->success("Company was created successfully");
		return $this->forward("products/index");
	}

	/**
	 * Saves current company in screen
	 *
	 * @param string $id
	 */
	public function saveAction()
	{
		if (!$this->request->isPost()) {
			return $this->forward("products/index");
		}

		$id = $this->request->getPost("id", "int");
		$company = Companies::findFirstById($id);
		if (!$company) {
			$this->flash->error("Company does not exist");
			return $this->forward("products/index");
		}

		$form = new CompaniesForm;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('products/new');
        }

        if ($company->save() == false) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('products/new');
        }

        $form->clear();

		$this->flash->success("Company was updated successfully");
		return $this->forward("products/index");
	}

	/**
	 * Deletes a company
	 *
	 * @param string $id
	 */
	public function deleteAction($id)
	{

		$products = Companies::findFirstById($id);
		if (!$products) {
			$this->flash->error("Company was not found");
			return $this->forward("products/index");
		}

		if (!$products->delete()) {
			foreach ($products->getMessages() as $message) {
				$this->flash->error($message);
			}
			return $this->forward("products/search");
		}

		$this->flash->success("Company was deleted");
		return $this->forward("products/index");
	}
}
