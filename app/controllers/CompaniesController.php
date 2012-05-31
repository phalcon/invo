<?php

use Phalcon_Tag as Tag;
use Phalcon_Flash as Flash;

class CompaniesController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Tag::setTitle('Manage your companies');
        parent::initialize();
    }

    public function beforeDispatch()
    {
        if (!Phalcon_Session::get('auth')) {
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
            $query = Phalcon_Model_Query::fromInput("Companies", $_POST);
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

        $companies = Companies::find($parameters);
        if (count($companies) == 0) {
            Flash::notice("The search did not find any companies", "alert alert-info");

            return $this->_forward("companies/index");
        }

        $paginator = Phalcon_Paginator::factory("Model", array(
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
        $request = Phalcon_Request::getInstance();
        if (!$request->isPost()) {

            $id = $this->filter->sanitize($id, array("int"));

            $companies = Companies::findFirst('id="' . $id . '"');
            if (!$companies) {
                Flash::error("companies was not found", "alert alert-error");

                return $this->_forward("companies/index");
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
            return $this->_forward("companies/index");
        }

        $companies = new Companies();
        $companies->id = $this->request->getPost("id", "int");
        $companies->name = $this->request->getPost("name");
        $companies->telephone = $this->request->getPost("telephone");
        $companies->address = $this->request->getPost("address");
        $companies->city = $this->request->getPost("city");

        $companies->name = strip_tags($companies->name);
        $companies->telephone = strip_tags($companies->telephone);
        $companies->address = strip_tags($companies->address);
        $companies->city = strip_tags($companies->city);

        if (!$companies->save()) {
            foreach ($companies->getMessages() as $message) {
                Flash::error((string) $message, "alert alert-error");
            }

            return $this->_forward("companies/new");
        } else {
            Flash::success("companies was created successfully", "alert alert-success");

            return $this->_forward("companies/index");
        }
    }

    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->_forward("companies/index");
        }

        $id = $this->request->getPost("id", "int");
        $companies = Companies::findFirst("id='$id'");
        if ($companies == false) {
            Flash::error("companies does not exist " . $id, "alert alert-error");

            return $this->_forward("companies/index");
        }
        $companies->id = $this->request->getPost("id", "int");
        $companies->name = $this->request->getPost("name");
        $companies->telephone = $this->request->getPost("telephone");
        $companies->address = $this->request->getPost("address");
        $companies->city = $this->request->getPost("city");

        $companies->name = strip_tags($companies->name);
        $companies->telephone = strip_tags($companies->telephone);
        $companies->address = strip_tags($companies->address);
        $companies->city = strip_tags($companies->city);

        if (!$companies->save()) {
            foreach ($companies->getMessages() as $message) {
                Flash::error((string) $message, "alert alert-error");
            }

            return $this->_forward("companies/edit/" . $companies->id);
        } else {
            Flash::success("companies was updated successfully", "alert alert-success");

            return $this->_forward("companies/index");
        }
    }

    public function deleteAction($id)
    {
        $id = $this->filter->sanitize($id, array("int"));

        $companies = Companies::findFirst('id="' . $id . '"');
        if (!$companies) {
            Flash::error("companies was not found", "alert alert-error");

            return $this->_forward("companies/index");
        }

        if (!$companies->delete()) {
            foreach ($companies->getMessages() as $message) {
                Flash::error((string) $message, "alert alert-error");
            }

            return $this->_forward("companies/search");
        } else {
            Flash::success("companies was deleted", "alert alert-success");

            return $this->_forward("companies/index");
        }
    }
}
