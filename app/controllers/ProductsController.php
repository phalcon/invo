<?php

use Phalcon_Tag as Tag;
use Phalcon_Flash as Flash;

class ProductsController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Tag::setTitle('Manage your product types');
        parent::initialize();
    }

    public function beforeDispatch()
    {
        if (!Phalcon_Session::get('auth')) {
            Flash::error('You don\'t have access to this module', 'alert alert-error');
            $this->_forward('index/index');
        }
    }

    function indexAction()
    {
        $this->session->conditions = null;
        $this->view->setVar("productTypes", ProductTypes::find());
    }

    function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Phalcon_Model_Query::fromInput("Products", $_POST);
            $this->session->conditions = $query->getConditions();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
            if ($numberPage <= 0) {
                $numberPage = 1;
            }
        }

        $parameters = array();
        if ($this->session->conditions) {
            $parameters["conditions"] = $this->session->conditions;
        }
        $parameters["order"] = "id";

        $products = Products::find($parameters);
        if (count($products) == 0) {
            Flash::notice("The search did not find any products", "alert alert-info");
            return $this->_forward("products/index");
        }

        $paginator = Phalcon_Paginator::factory("Model", array(
                    "data" => $products,
                    "limit" => 5,
                    "page" => $numberPage
                ));
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
        $this->view->setVar("products", $products);
    }

    function newAction()
    {
        $this->view->setVar("productTypes", ProductTypes::find());
    }

    function editAction($id)
    {
        $request = Phalcon_Request::getInstance();
        if (!$request->isPost()) {

            $id = $this->filter->sanitize($id, array("int"));

            $products = Products::findFirst('id="' . $id . '"');
            if (!$products) {
                Flash::error("products was not found", "alert alert-error");
                return $this->_forward("products/index");
            }
            $this->view->setVar("id", $products->id);

            Tag::displayTo("id", $products->id);
            Tag::displayTo("product_types_id", $products->product_types_id);
            Tag::displayTo("name", $products->name);
            Tag::displayTo("price", $products->price);
            Tag::displayTo("active", $products->active);

            $this->view->setVar("productTypes", ProductTypes::find());
        }
    }

    function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->_forward("products/index");
        }

        $products = new Products();
        $products->id = $this->request->getPost("id", "int");
        $products->product_types_id = $this->request->getPost("product_types_id", "int");
        $products->name = $this->request->getPost("name");
        $products->price = $this->request->getPost("price");
        $products->active = $this->request->getPost("active");

        $products->name = strip_tags($products->name);

        if (!$products->save()) {
            foreach ($products->getMessages() as $message) {
                Flash::error((string) $message, "alert alert-error");
            }
            return $this->_forward("products/new");
        } else {
            Flash::success("products was created successfully", "alert alert-success");
            return $this->_forward("products/index");
        }
    }

    function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->_forward("products/index");
        }

        $id = $this->request->getPost("id", "int");
        $products = Products::findFirst("id='$id'");
        if ($products == false) {
            Flash::error("products does not exist " . $id, "alert alert-error");
            return $this->_forward("products/index");
        }
        $products->id = $this->request->getPost("id", "int");
        $products->product_types_id = $this->request->getPost("product_types_id", "int");
        $products->name = $this->request->getPost("name");
        $products->price = $this->request->getPost("price");
        $products->active = $this->request->getPost("active");

        $products->name = strip_tags($products->name);

        if (!$products->save()) {
            foreach ($products->getMessages() as $message) {
                Flash::error((string) $message, "alert alert-error");
            }
            return $this->_forward("products/edit/" . $products->id);
        } else {
            Flash::success("products was updated successfully", "alert alert-success");
            return $this->_forward("products/index");
        }
    }

    function deleteAction($id)
    {
        $id = $this->filter->sanitize($id, array("int"));

        $products = Products::findFirst('id="' . $id . '"');
        if (!$products) {
            Flash::error("products was not found", "alert alert-error");
            return $this->_forward("products/index");
        }

        if (!$products->delete()) {
            foreach ($products->getMessages() as $message) {
                Flash::error((string) $message, "alert alert-error");
            }
            return $this->_forward("products/search");
        } else {
            Flash::success("products was deleted", "alert alert-success");
            return $this->_forward("products/index");
        }
    }
}
