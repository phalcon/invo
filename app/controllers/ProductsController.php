<?php

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;

class ProductsController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Tag::setTitle('Manage your product types');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->persistent->searchParams = null;
        $this->view->setVar("productTypes", ProductTypes::find());
    }

    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Products", $_POST);
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

        $products = Products::find($parameters);
        if (count($products) == 0) {
            $this->flash->notice("The search did not find any products");
            return $this->forward("products/index");
        }

        $paginator = new Phalcon\Paginator\Adapter\Model(array(
            "data" => $products,
            "limit" => 5,
            "page" => $numberPage
        ));
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
    }

    public function newAction()
    {
        $this->view->setVar("productTypes", ProductTypes::find());
    }

    public function editAction($id)
    {
        $request = $this->request;
        if (!$request->isPost()) {

            $id = $this->filter->sanitize($id, array("int"));

            $products = Products::findFirst('id="' . $id . '"');
            if (!$products) {
                $this->flash->error("products was not found");
                return $this->forward("products/index");
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

    public function createAction()
    {

        $request = $this->request;

        if (!$request->isPost()) {
            return $this->forward("products/index");
        }

        $products = new Products();
        $products->id = $request->getPost("id", "int");
        $products->product_types_id = $request->getPost("product_types_id", "int");
        $products->name = $request->getPost("name", "striptags");
        $products->price = $request->getPost("price");
        $products->active = $request->getPost("active");

        if (!$products->save()) {

            foreach ($products->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->forward("products/new");

        } else {
            $this->flash->success("products was created successfully");
            return $this->forward("products/index");
        }
    }

    public function saveAction()
    {
        $request = $this->request;
        if (!$request->isPost()) {
            return $this->forward("products/index");
        }

        $id = $request->getPost("id", "int");
        $products = Products::findFirst("id='$id'");
        if ($products == false) {
            $this->flash->error("products does not exist ".$id);
            return $this->forward("products/index");
        }

        $products->id = $request->getPost("id", "int");
        $products->product_types_id = $request->getPost("product_types_id", "int");
        $products->name = $request->getPost("name");
        $products->price = $request->getPost("price");
        $products->active = $request->getPost("active");

        $products->name = strip_tags($products->name);

        if (!$products->save()) {
            foreach ($products->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            return $this->forward("products/edit/" . $products->id);
        } else {
            $this->flash->success("Product was successfully updated");
            return $this->forward("products/index");
        }
    }

    public function deleteAction($id)
    {
        $id = $this->filter->sanitize($id, array("int"));

        $products = Products::findFirst('id="' . $id . '"');
        if (!$products) {
            $this->flash->error("Product was not found");
            return $this->forward("products/index");
        }

        if (!$products->delete()) {
            foreach ($products->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->forward("products/search");
        } else {
            $this->flash->success("Products was deleted");
            return $this->forward("products/index");
        }
    }
}
