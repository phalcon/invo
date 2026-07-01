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

use Invo\Constants\Status;
use Invo\Forms\ProductsForm;
use Invo\Models\Products;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

/**
 * ProductsController
 *
 * Manage CRUD operations for products
 */
class ProductsController extends ControllerBase
{
    /**
     * Creates a new product
     */
    public function createAction(): void
    {
        if (!$this->request->isPost()) {
            $this->forward('products', 'index');

            return;
        }

        $form            = new ProductsForm();
        $product         = new Products();
        $product->active = Status::ACTIVE;

        if (!$form->isValid($this->request->getPost(), $product)) {
            $this->flashErrorsAndForward($form->getMessages(), 'products', 'new');

            return;
        }

        if (!$product->save()) {
            $this->flashErrorsAndForward($product->getMessages(), 'products', 'new');

            return;
        }

        $form->clear();
        $this->flash->success('Product was created successfully');

        $this->forward('products', 'index');
    }

    /**
     * Deletes a product
     *
     * @param string $id
     */
    public function deleteAction($id): void
    {
        $products = Products::findFirstById($id);
        if (!$products) {
            $this->notFound('Product was not found', 'products', 'index');

            return;
        }

        if (!$products->delete()) {
            $this->flashErrorsAndForward($products->getMessages(), 'products', 'search');

            return;
        }

        $this->flash->success('Product was deleted');

        $this->forward('products', 'index');
    }

    /**
     * Edits a product based on its id
     *
     * @param $id
     */
    public function editAction($id): void
    {
        $product = Products::findFirstById($id);
        if (!$product) {
            $this->notFound('Product was not found', 'products', 'index');

            return;
        }

        $this->view->form = new ProductsForm($product, ['edit' => true]);
    }

    /**
     * Shows the index action
     */
    public function indexAction(): void
    {
        $this->view->form = new ProductsForm();
    }
    public function initialize()
    {
        parent::initialize();

        $this->tag->title()
                  ->set('Manage your products')
        ;
    }

    /**
     * Shows the form to create a new product
     */
    public function newAction(): void
    {
        $this->view->form = new ProductsForm(null, ['edit' => true]);
    }

    /**
     * Saves current product in screen
     */
    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            $this->forward('products', 'index');

            return;
        }

        $id      = $this->request->getPost('id', 'int');
        $product = Products::findFirstById($id);
        if (!$product) {
            $this->notFound('Product does not exist', 'products', 'index');

            return;
        }

        $form             = new ProductsForm();
        $this->view->form = $form;
        $data             = $this->request->getPost();

        if (!$form->isValid($data, $product)) {
            $this->flashErrorsAndForward($form->getMessages(), 'products', 'edit', [$id]);

            return;
        }

        if (!$product->save()) {
            $this->flashErrorsAndForward($product->getMessages(), 'products', 'edit', [$id]);

            return;
        }

        $form->clear();
        $this->flash->success('Product was updated successfully');

        $this->forward('products', 'index');
    }

    /**
     * Search products based on current criteria
     */
    public function searchAction(): void
    {
        if ($this->request->isPost()) {
            $query = Criteria::fromInput(
                $this->di,
                Products::class,
                $this->request->getPost()
            );

            $this->persistent->searchParams = ['di' => null] + $query->getParams();
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $products = Products::find($parameters);
        if (count($products) == 0) {
            $this->flash->notice('The search did not find any products');

            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);

            return;
        }

        $paginator = new Paginator([
            'model' => Products::class,
            'parameters' => $parameters,
            'limit' => 10,
            'page'  => $this->request->getQuery('page', 'int', 1),
        ]);

        $this->view->page = $paginator->paginate();
    }
}
