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
        $this->session->conditions = null;
        $this->view->form = new ProductsForm;
    }

    /**
     * Search products based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput(
                $this->di,
                'Products',
                $this->request->getPost()
            );

            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery('page', 'int');
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $products = Products::find($parameters);
        if (count($products) == 0) {
            $this->flash->notice('The search did not find any products');

            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);
        }

        $paginator = new Paginator([
            'data'  => $products,
            'limit' => 10,
            'page'  => $numberPage,
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

            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);
        }

        $this->view->form = new ProductsForm($product, ['edit' => true]);
    }

    /**
     * Creates a new product
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);
        }

        $form = new ProductsForm;
        $product = new Products();

        $data = $this->request->getPost();

        if (!$form->isValid($data, $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'new',
            ]);
        }

        if (!$product->save()) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'new',
            ]);
        }

        $form->clear();
        $this->flash->success('Product was created successfully');

        return $this->dispatcher->forward([
            'controller' => 'products',
            'action'     => 'index',
        ]);
    }

    /**
     * Saves current product in screen
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);
        }

        $id = $this->request->getPost('id', 'int');
        $product = Products::findFirstById($id);
        if (!$product) {
            $this->flash->error('Product does not exist');

            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);
        }

        $form = new ProductsForm;
        $this->view->form = $form;
        $data = $this->request->getPost();

        if (!$form->isValid($data, $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'edit',
                'params'     => [$id],
            ]);
        }

        if (!$product->save()) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'edit',
                'params'     => [$id],
            ]);
        }

        $form->clear();
        $this->flash->success('Product was updated successfully');

        return $this->dispatcher->forward([
            'controller' => 'products',
            'action'     => 'index',
        ]);
    }

    /**
     * Deletes a product
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $products = Products::findFirstById($id);
        if (!$products) {
            $this->flash->error('Product was not found');

            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);
        }

        if (!$products->delete()) {
            foreach ($products->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'search',
            ]);
        }

        $this->flash->success('Product was deleted');

        return $this->dispatcher->forward([
            'controller' => 'products',
            'action'     => 'index',
        ]);
    }
}
