<?php
declare(strict_types=1);

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
    public function initialize()
    {
        $this->tag->setTitle('Manage your products types');

        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction(): void
    {
        $this->view->form = new ProductTypesForm;
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

            $this->persistent->searchParams = $query->getParams();
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $productTypes = ProductTypes::find($parameters);
        if (count($productTypes) === 0) {
            $this->flash->notice('The search did not find any product types');

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'index',
            ]);

            return;
        }

        $paginator = new Paginator([
            'data'  => $productTypes,
            'limit' => 10,
            'page'  => $this->request->getQuery('page', 'int', 1),
        ]);

        $this->view->page = $paginator->paginate();
        $this->view->productTypes = $productTypes;
    }

    /**
     * Shows the form to create a new producttype
     */
    public function newAction(): void
    {
        $this->view->form = new ProductTypesForm(null, ['edit' => true]);
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
            $this->flash->error('Product type to edit was not found');

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'index',
            ]);

            return;
        }

        $this->view->form = new ProductTypesForm($productTypes, ['edit' => true]);
    }

    /**
     * Creates a new producttype
     */
    public function createAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'index',
            ]);

            return;
        }

        $form = new ProductTypesForm();
        $productTypes = new ProductTypes();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $productTypes)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'new',
            ]);

            return;
        }

        if (!$productTypes->save()) {
            foreach ($productTypes->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'new',
            ]);

            return;
        }

        $form->clear();
        $this->flash->success('Product type was created successfully');

        $this->dispatcher->forward([
            'controller' => 'producttypes',
            'action'     => 'index',
        ]);
    }

    /**
     * Saves current producttypes in screen
     */
    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'index',
            ]);

            return;
        }

        $id = $this->request->getPost('id', 'int');
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->flash->error('productTypes does not exist');

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'index',
            ]);

            return;
        }

        $form = new ProductTypesForm();
        if (!$form->isValid($this->request->getPost(), $productTypes)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'new',
            ]);

            return;
        }

        if (!$productTypes->save()) {
            foreach ($productTypes->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'new',
            ]);

            return;
        }

        $form->clear();
        $this->flash->success('Product Type was updated successfully');

        $this->dispatcher->forward([
            'controller' => 'producttypes',
            'action'     => 'index',
        ]);
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
            $this->flash->error('Product types was not found');

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'index',
            ]);

            return;
        }

        if (!$productTypes->delete()) {
            foreach ($productTypes->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action'     => 'search',
            ]);

            return;
        }

        $this->flash->success('Product types was deleted');

        $this->dispatcher->forward([
            'controller' => 'producttypes',
            'action'     => 'index',
        ]);
    }
}
