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

use Invo\Forms\CompaniesForm;
use Invo\Models\Companies;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CompaniesController extends ControllerBase
{
    /**
     * Creates a new company
     */
    public function createAction(): void
    {
        if (!$this->request->isPost()) {
            $this->forward('companies', 'index');

            return;
        }

        $form    = new CompaniesForm();
        $company = new Companies();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $company)) {
            $this->flashErrorsAndForward($form->getMessages(), 'companies', 'new');

            return;
        }

        if (!$company->save()) {
            $this->flashErrorsAndForward($company->getMessages(), 'companies', 'new');

            return;
        }

        $form->clear();
        $this->flash->success('Company was created successfully');

        $this->forward('companies', 'index');
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
            $this->notFound('Company was not found', 'companies', 'index');

            return;
        }

        if (!$companies->delete()) {
            $this->flashErrorsAndForward($companies->getMessages(), 'companies', 'search');

            return;
        }

        $this->flash->success('Company was deleted');

        $this->forward('companies', 'index');
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
            $this->notFound('Company was not found', 'companies', 'index');

            return;
        }

        $this->view->form = new CompaniesForm($company, ['edit' => true]);
    }

    /**
     * Shows the index action
     */
    public function indexAction(): void
    {
        $this->view->form = new CompaniesForm();
    }
    public function initialize()
    {
        parent::initialize();

        $this->tag->title()
                  ->set('Manage your companies')
        ;
    }

    /**
     * Shows the form to create a new company
     */
    public function newAction(): void
    {
        $this->view->form = new CompaniesForm(null, ['edit' => true]);
    }

    /**
     * Saves current company in screen
     */
    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            $this->forward('companies', 'index');

            return;
        }

        $id      = $this->request->getPost('id', 'int');
        $company = Companies::findFirstById($id);
        if (!$company) {
            $this->notFound('Company does not exist', 'companies', 'index');

            return;
        }

        $data = $this->request->getPost();
        $form = new CompaniesForm();
        if (!$form->isValid($data, $company)) {
            $this->flashErrorsAndForward($form->getMessages(), 'companies', 'new');

            return;
        }

        if (!$company->save()) {
            $this->flashErrorsAndForward($company->getMessages(), 'companies', 'new');

            return;
        }

        $form->clear();
        $this->flash->success('Company was updated successfully');

        $this->forward('companies', 'index');
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

            $this->persistent->searchParams = ['di' => null] + $query->getParams();
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
            'model' => Companies::class,
            'parameters' => $parameters,
            'limit' => 10,
            'page'  => $this->request->getQuery('page', 'int', 1),
        ]);

        $this->view->page      = $paginator->paginate();
        $this->view->companies = $companies;
    }
}
