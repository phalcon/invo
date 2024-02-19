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

use Invo\Forms\ProfileForm;
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
        $this->tag->title()
                  ->set('Manage your Invoices')
        ;

        parent::initialize();
    }

    public function indexAction(): void
    {
    }

    /**
     * Edit the active user profile
     */
    public function profileAction(): void
    {
        //Get session info
        $auth = $this->session->get('auth');

        //Query the active user
        $user = Users::findFirst($auth['id']);
        if (!$user) {
            $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);

            return;
        }

        // Pass user to fill the form with the user data
        $form = new ProfileForm($user);

        if ($this->request->isPost()) {
            $data = $this->request->getPost();

            if ($form->isValid($data, $user)) {
                if (!$user->save()) {
                    foreach ($user->getMessages() as $message) {
                        $this->flash->error((string) $message);
                    }
                } else {
                    $this->flash->success('Your profile information was updated successfully');
                }
            } else {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            }
        }

        $this->view->form = $form;
    }
}
