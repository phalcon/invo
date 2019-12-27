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
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Manage your products');
    }

    /**
     * Shows the index action
     */
    public function indexAction(): void
    {
        $this->view->form = new ProductsForm;
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

            $this->persistent->searchParams = $query->getParams();
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
            'data'  => $products,
            'limit' => 10,
            'page'  => $this->request->getQuery('page', 'int', 1),
        ]);

        $this->view->page = $paginator->paginate();
    }

    /**
     * Shows the form to create a new product
     */
    public function newAction(): void
    {
        $this->view->form = new ProductsForm(null, ['edit' => true]);
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
            $this->flash->error('Product was not found');

            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);

            return;
        }

        $this->view->form = new ProductsForm($product, ['edit' => true]);
    }

    /**
     * Creates a new product
     */
    public function createAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);

            return;
        }

        $form = new ProductsForm();
        $product = new Products();

        if (!$form->isValid($this->request->getPost(), $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'new',
            ]);

            return;
        }

        if (!$product->save()) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'new',
            ]);

            return;
        }

        $form->clear();
        $this->flash->success('Product was created successfully');

        $this->dispatcher->forward([
            'controller' => 'products',
            'action'     => 'index',
        ]);
    }

    /**
     * Saves current product in screen
     */
    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);

            return;
        }

        $id = $this->request->getPost('id', 'int');
        $product = Products::findFirstById($id);
        if (!$product) {
            $this->flash->error('Product does not exist');

            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);

            return;
        }

        $form = new ProductsForm();
        $this->view->form = $form;
        $data = $this->request->getPost();

        if (!$form->isValid($data, $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'edit',
                'params'     => [$id],
            ]);

            return;
        }

        if (!$product->save()) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'edit',
                'params'     => [$id],
            ]);

            return;
        }

        $form->clear();
        $this->flash->success('Product was updated successfully');

        $this->dispatcher->forward([
            'controller' => 'products',
            'action'     => 'index',
        ]);
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
            $this->flash->error('Product was not found');

            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);

            return;
        }

        if (!$products->delete()) {
            foreach ($products->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'search',
            ]);

            return;
        }

        $this->flash->success('Product was deleted');

        $this->dispatcher->forward([
            'controller' => 'products',
            'action'     => 'index',
        ]);
    }
}
