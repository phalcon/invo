<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CompaniesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your companies');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new CompaniesForm;
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Companies", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
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

        $paginator = new Paginator(array(
            "data"  => $companies,
            "limit" => 10,
            "page"  => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
        $this->view->companies = $companies;
    }

    /**
     * Shows the form to create a new company
     */
    public function newAction()
    {
        $this->view->form = new CompaniesForm(null, array('edit' => true));
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $company = Companies::findFirstById($id);
            if (!$company) {
                $this->flash->error("Company was not found");
                return $this->forward("companies/index");
            }

            $this->view->form = new CompaniesForm($company, array('edit' => true));
        }
    }

    /**
     * Creates a new company
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("companies/index");
        }

        $form = new CompaniesForm;
        $company = new Companies();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('companies/new');
        }

        if ($company->save() == false) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('companies/new');
        }

        $form->clear();

        $this->flash->success("Company was created successfully");
        return $this->forward("companies/index");
    }

    /**
     * Saves current company in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("companies/index");
        }

        $id = $this->request->getPost("id", "int");
        $company = Companies::findFirstById($id);
        if (!$company) {
            $this->flash->error("Company does not exist");
            return $this->forward("companies/index");
        }

        $form = new CompaniesForm;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('companies/new');
        }

        if ($company->save() == false) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('companies/new');
        }

        $form->clear();

        $this->flash->success("Company was updated successfully");
        return $this->forward("companies/index");
    }

    /**
     * Deletes a company
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $companies = Companies::findFirstById($id);
        if (!$companies) {
            $this->flash->error("Company was not found");
            return $this->forward("companies/index");
        }

        if (!$companies->delete()) {
            foreach ($companies->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("companies/search");
        }

        $this->flash->success("Company was deleted");
        return $this->forward("companies/index");
    }
}
