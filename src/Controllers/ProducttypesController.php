<?php

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Invo\Controllers;

use Invo\Forms\ProductTypesForm;
use Invo\Models\ProductTypes;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

/**
 * ProductTypesController
 *
 * Manage operations for product of types
 */
class ProducttypesController extends ControllerBase
{
    /**
     * Creates a new producttype
     */
    public function createAction(): void
    {
        if (!$this->request->isPost()) {
            $this->forward('producttypes', 'index');

            return;
        }

        $form         = new ProductTypesForm();
        $productTypes = new ProductTypes();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $productTypes)) {
            $this->flashErrorsAndForward($form->getMessages(), 'producttypes', 'new');

            return;
        }

        if (!$productTypes->save()) {
            $this->flashErrorsAndForward($productTypes->getMessages(), 'producttypes', 'new');

            return;
        }

        $form->clear();
        $this->flash->success('Product type was created successfully');

        $this->forward('producttypes', 'index');
    }

    /**
     * Deletes a producttypes
     *
     * @param int $id
     */
    public function deleteAction($id): void
    {
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->notFound('Product types was not found', 'producttypes', 'index');

            return;
        }

        if (!$productTypes->delete()) {
            $this->flashErrorsAndForward($productTypes->getMessages(), 'producttypes', 'search');

            return;
        }

        $this->flash->success('Product types was deleted');

        $this->forward('producttypes', 'index');
    }

    /**
     * Edits a producttype based on its id
     *
     * @param int $id
     */
    public function editAction($id): void
    {
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->notFound('Product type to edit was not found', 'producttypes', 'index');

            return;
        }

        $this->view->form = new ProductTypesForm($productTypes, ['edit' => true]);
    }

    /**
     * Shows the index action
     */
    public function indexAction(): void
    {
        $this->view->form = new ProductTypesForm();
    }
    public function initialize()
    {
        $this->tag->title()
                  ->set('Manage your products types')
        ;

        parent::initialize();
    }

    /**
     * Shows the form to create a new producttype
     */
    public function newAction(): void
    {
        $this->view->form = new ProductTypesForm(null, ['edit' => true]);
    }

    /**
     * Saves current producttypes in screen
     */
    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            $this->forward('producttypes', 'index');

            return;
        }

        $id           = $this->request->getPost('id', 'int');
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->notFound('productTypes does not exist', 'producttypes', 'index');

            return;
        }

        $form = new ProductTypesForm();
        if (!$form->isValid($this->request->getPost(), $productTypes)) {
            $this->flashErrorsAndForward($form->getMessages(), 'producttypes', 'new');

            return;
        }

        if (!$productTypes->save()) {
            $this->flashErrorsAndForward($productTypes->getMessages(), 'producttypes', 'new');

            return;
        }

        $form->clear();
        $this->flash->success('Product Type was updated successfully');

        $this->forward('producttypes', 'index');
    }

    /**
     * Search producttype based on current criteria
     */
    public function searchAction(): void
    {
        if ($this->request->isPost()) {
            $query = Criteria::fromInput(
                $this->di,
                ProductTypes::class,
                $this->request->getPost()
            );

            $this->persistent->searchParams = ['di' => null] + $query->getParams();
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $productTypes = ProductTypes::find($parameters);
        if (count($productTypes) === 0) {
            $this->flash->notice('The search did not find any product types');

            $this->forward('producttypes', 'index');

            return;
        }

        $paginator = new Paginator([
            'model' => ProductTypes::class,
            'parameters' => $parameters,
            'limit' => 10,
            'page'  => $this->request->getQuery('page', 'int', 1),
        ]);

        $this->view->page         = $paginator->paginate();
        $this->view->productTypes = $productTypes;
    }
}
