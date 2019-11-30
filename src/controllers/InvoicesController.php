<?php
declare(strict_types=1);

namespace Invo\Controllers;

use Invo\Models\Users;

/**
 * InvoicesController
 *
 * Manage operations for invoices
 */
class InvoicesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your Invoices');

        parent::initialize();
    }

    public function indexAction(): void
    {
    }

    /**
     * Edit the active user profile
     */
    public function profileAction()
    {
        //Get session info
        $auth = $this->session->get('auth');

        //Query the active user
        $user = Users::findFirst($auth['id']);
        if (!$user) {
            return $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);
        }

        if (!$this->request->isPost()) {
            $this->tag->setDefault('name', $user->name);
            $this->tag->setDefault('email', $user->email);
        } else {
            $user->name = $this->request->getPost('name', ['string', 'striptags']);
            $user->email = $this->request->getPost('email', 'email');

            if (!$user->save()) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->flash->success('Your profile information was updated successfully');
            }
        }
    }
}
