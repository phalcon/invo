<?php

use Phalcon\Tag as Tag;
use Phalcon\Flash as Flash;

class ProductTypesController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Tag::setTitle('Manage your products');
        parent::initialize();
    }

    public function beforeDispatch()
    {
        if (!Phalcon\Session::get('auth')) {
            Flash::error('You don\'t have access to this module', 'alert alert-error');
            $this->_forward('index/index');
        }
    }

    public function indexAction()
    {
        $this->session->conditions = null;
    }

    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Phalcon\Model\Query::fromInput("ProductTypes", $_POST);
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

        $producttypes = ProductTypes::find($parameters);
        if (count($producttypes) == 0) {
            Flash::notice("The search did not find any product types", "alert alert-info");
            return $this->_forward("producttypes/index");
        }

        $paginator = Phalcon\Paginator::factory("Model", array(
            "data" => $producttypes,
            "limit" => 10,
            "page" => $numberPage
        ));
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
        $this->view->setVar("producttypes", $producttypes);
    }

    public function newAction()
    {
    }

    public function editAction($id)
    {
        $request = Phalcon\Request::getInstance();
        if (!$request->isPost()) {

            $id = $this->filter->sanitize($id, array("int"));

            $producttypes = ProductTypes::findFirst('id="' . $id . '"');
            if (!$producttypes) {
                Flash::error("product types was not found", "alert alert-error");

                return $this->_forward("producttypes/index");
            }
            $this->view->setVar("id", $producttypes->id);

            Tag::displayTo("id", $producttypes->id);
            Tag::displayTo("name", $producttypes->name);
        }
    }

    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->_forward("producttypes/index");
        }

        $producttypes = new ProductTypes();
        $producttypes->id = $this->request->getPost("id", "int");
        $producttypes->name = $this->request->getPost("name");

        $producttypes->name = strip_tags($producttypes->name);

        if (!$producttypes->save()) {
            foreach ($producttypes->getMessages() as $message) {
                Flash::error((string) $message, "alert alert-error");
            }
            return $this->_forward("producttypes/new");
        } else {
            Flash::success("product types was created successfully", "alert alert-success");
            return $this->_forward("producttypes/index");
        }
    }

    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->_forward("producttypes/index");
        }

        $id = $this->request->getPost("id", "int");
        $producttypes = ProductTypes::findFirst("id='$id'");
        if ($producttypes == false) {
            Flash::error("product types does not exist " . $id, "alert alert-error");

            return $this->_forward("producttypes/index");
        }
        $producttypes->id = $this->request->getPost("id", "int");
        $producttypes->name = $this->request->getPost("name");

        $producttypes->name = strip_tags($producttypes->name);

        if (!$producttypes->save()) {
            foreach ($producttypes->getMessages() as $message) {
                Flash::error((string) $message, "alert alert-error");
            }
            return $this->_forward("producttypes/edit/" . $producttypes->id);
        } else {
            Flash::success("product types was updated successfully", "alert alert-success");
            return $this->_forward("producttypes/index");
        }
    }

    public function deleteAction($id)
    {
        $id = $this->filter->sanitize($id, array("int"));

        $producttypes = ProductTypes::findFirst('id="' . $id . '"');
        if (!$producttypes) {
            Flash::error("product types was not found", "alert alert-error");

            return $this->_forward("producttypes/index");
        }

        if (!$producttypes->delete()) {
            foreach ($producttypes->getMessages() as $message) {
                Flash::error((string) $message, "alert alert-error");
            }
            return $this->_forward("producttypes/search");
        } else {
            Flash::success("product types was deleted", "alert alert-success");
            return $this->_forward("producttypes/index");
        }
    }
}
