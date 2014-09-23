<?php

use Phalcon\Mvc\Model\Criteria;

class ProductTypesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your products');
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
            $query = Criteria::fromInput($this->di, "ProductTypes", $_POST);
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

        $productTypes = ProductTypes::find($parameters);
        if (count($productTypes) == 0) {
            $this->flash->notice("The search did not find any product types");
            return $this->forward("producttypes/index");
        }

        $paginator = new Phalcon\Paginator\Adapter\Model(array(
            "data" => $productTypes,
            "limit" => 10,
            "page" => $numberPage
        ));
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
        $this->view->setVar("productTypes", $productTypes);
    }

    public function newAction()
    {
    }

    public function editAction($id)
    {
        $request = $this->request;
        if (!$request->isPost()) {

            $producttypes = ProductTypes::findFirstById($id);
            if (!$producttypes) {
                $this->flash->error("Product type to edit was not found");
                return $this->forward("producttypes/index");
            }
            $this->view->setVar("id", $producttypes->id);

            $this->tag->displayTo("id", $producttypes->id);
            $this->tag->displayTo("name", $producttypes->name);
        }
    }

    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("producttypes/index");
        }

        $producttypes = new ProductTypes();
        $producttypes->id = $this->request->getPost("id", "int");
        $producttypes->name = $this->request->getPost("name");

        $producttypes->name = strip_tags($producttypes->name);

        if (!$producttypes->save()) {
            foreach ($producttypes->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->forward("producttypes/new");
        } else {
            $this->flash->success("Product type was created successfully");
            return $this->forward("producttypes/index");
        }
    }

    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("producttypes/index");
        }

        $id = $this->request->getPost("id", "int");
        $producttypes = ProductTypes::findFirst("id='$id'");
        if ($producttypes == false) {
            $this->flash->error("product types does not exist " . $id);

            return $this->forward("producttypes/index");
        }
        $producttypes->id = $this->request->getPost("id", "int");
        $producttypes->name = $this->request->getPost("name", "striptags");

        if (!$producttypes->save()) {
            foreach ($producttypes->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->forward("producttypes/edit/" . $producttypes->id);
        } else {
            $this->flash->success("Product Type was updated successfully");
            return $this->forward("producttypes/index");
        }
    }

    public function deleteAction($id)
    {
        $id = $this->filter->sanitize($id, array("int"));

        $producttypes = ProductTypes::findFirst('id="' . $id . '"');
        if (!$producttypes) {
            $this->flash->error("product types was not found");

            return $this->forward("producttypes/index");
        }

        if (!$producttypes->delete()) {
            foreach ($producttypes->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->forward("producttypes/search");
        } else {
            $this->flash->success("product types was deleted");
            return $this->forward("producttypes/index");
        }
    }
}
