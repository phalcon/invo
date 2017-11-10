<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

/**
 * ProductTypesController
 *
 * Manage operations for product of types
 */
class ProductTypesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your products types');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new ProductTypesForm;
    }

    /**
     * Search producttype based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "ProductTypes", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $productTypes = ProductTypes::find($parameters);
        if (count($productTypes) == 0) {
            $this->flash->notice("The search did not find any product types");

            return $this->dispatcher->forward(
                [
                    "controller" => "producttypes",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $productTypes,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->productTypes = $productTypes;
    }

    /**
     * Shows the form to create a new producttype
     */
    public function newAction()
    {
        $this->view->form = new ProductTypesForm(null, ['edit' => true]);
    }

    /**
     * Edits a producttype based on its id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $producttypes = ProductTypes::findFirstById($id);
            if (!$producttypes) {
                $this->flash->error("Product type to edit was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "producttypes",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new ProductTypesForm($producttypes, ['edit' => true]);
        }
    }

    /**
     * Creates a new producttype
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "producttypes",
                    "action"     => "index",
                ]
            );
        }

        $form = new ProductTypesForm;
        $producttypes = new ProductTypes();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $producttypes)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "producttypes",
                    "action"     => "new",
                ]
            );
        }

        if ($producttypes->save() == false) {
            foreach ($producttypes->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "producttypes",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Product type was created successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "producttypes",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current producttypes in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "producttypes",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->flash->error("productTypes does not exist");
            return $this->dispatcher->forward(
                [
                    "controller" => "producttypes",
                    "action"     => "index",
                ]
            );
        }

        $form = new ProductTypesForm;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $productTypes)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "producttypes",
                    "action"     => "new",
                ]
            );
        }

        if ($productTypes->save() == false) {
            foreach ($productTypes->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "producttypes",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Product Type was updated successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "producttypes",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a producttypes
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->flash->error("Product types was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "producttypes",
                    "action"     => "index",
                ]
            );
        }

        if (!$productTypes->delete()) {
            foreach ($productTypes->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "producttypes",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("product types was deleted");

        return $this->dispatcher->forward(
            [
                "controller" => "producttypes",
                "action"     => "index",
            ]
        );
    }
}
