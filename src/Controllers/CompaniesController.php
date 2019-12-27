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

use Invo\Forms\CompaniesForm;
use Invo\Models\Companies;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CompaniesController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Manage your companies');
    }

    /**
     * Shows the index action
     */
    public function indexAction(): void
    {
        $this->view->form = new CompaniesForm();
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction(): void
    {
        if ($this->request->isPost()) {
            $query = Criteria::fromInput(
                $this->di,
                Companies::class,
                $this->request->getPost()
            );

            $this->persistent->searchParams = $query->getParams();
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $companies = Companies::find($parameters);
        if (count($companies) == 0) {
            $this->flash->notice('The search did not find any companies');

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'index',
            ]);

            return;
        }

        $paginator = new Paginator([
            'data'  => $companies,
            'limit' => 10,
            'page'  => $this->request->getQuery('page', 'int', 1),
        ]);

        $this->view->page = $paginator->paginate();
        $this->view->companies = $companies;
    }

    /**
     * Shows the form to create a new company
     */
    public function newAction(): void
    {
        $this->view->form = new CompaniesForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     *
     * @param int $id
     */
    public function editAction($id): void
    {
        $company = Companies::findFirstById($id);
        if (!$company) {
            $this->flash->error('Company was not found');

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'index',
            ]);

            return;
        }

        $this->view->form = new CompaniesForm($company, ['edit' => true]);
    }

    /**
     * Creates a new company
     */
    public function createAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'index',
            ]);

            return;
        }

        $form = new CompaniesForm();
        $company = new Companies();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'new',
            ]);

            return;
        }

        if (!$company->save()) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'new',
            ]);

            return;
        }

        $form->clear();
        $this->flash->success('Company was created successfully');

        $this->dispatcher->forward([
            'controller' => 'companies',
            'action'     => 'index',
        ]);
    }

    /**
     * Saves current company in screen
     */
    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'index',
            ]);

            return;
        }

        $id = $this->request->getPost('id', 'int');
        $company = Companies::findFirstById($id);
        if (!$company) {
            $this->flash->error('Company does not exist');

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'index',
            ]);

            return;
        }

        $data = $this->request->getPost();
        $form = new CompaniesForm();
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'new',
            ]);

            return;
        }

        if (!$company->save()) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'new',
            ]);

            return;
        }

        $form->clear();
        $this->flash->success('Company was updated successfully');

        $this->dispatcher->forward([
            'controller' => 'companies',
            'action'     => 'index',
        ]);
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
            $this->flash->error('Company was not found');

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'index',
            ]);

            return;
        }

        if (!$companies->delete()) {
            foreach ($companies->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'search',
            ]);

            return;
        }

        $this->flash->success('Company was deleted');

        $this->dispatcher->forward([
            'controller' => 'companies',
            'action'     => 'index',
        ]);
    }
}
