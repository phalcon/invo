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
use Invo\Forms\LoginForm;
use Invo\Models\Users;

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->title()
                  ->set('Sign Up/Sign In')
        ;
    }

    public function indexAction(): void
    {
        $form = new LoginForm();

        // Set default Invo user credentials
        $form->get('email')->setDefault('demo');
        $form->get('password')->setDefault('phalcon');

        $this->view->setVar('form', $form);
    }

    /**
     * This action authenticate and logs an user into the application
     */
    public function startAction(): void
    {
        if ($this->request->isPost()) {
            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            /** @var Users $user */
            $user = Users::findFirst(
                [
                    "conditions" => "(email = :email: OR username = :email:) "
                        . "AND password = :password: "
                        . "AND active = :active:",
                    'bind'       => [
                        'email'    => $email,
                        'password' => sha1($password),
                        'active'   => Status::ACTIVE,
                    ],
                ]
            );

            if ($user) {
                $this->registerSession($user);
                $this->flash->success('Welcome ' . $user->name);

                $this->dispatcher->forward([
                    'controller' => 'invoices',
                    'action'     => 'index',
                ]);

                return;
            }

            $this->flash->error('Wrong email/password');
        }

        $this->dispatcher->forward([
            'controller' => 'session',
            'action'     => 'index',
        ]);
    }

    /**
     * Finishes the active session redirecting to the index
     */
    public function endAction(): void
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');

        $this->dispatcher->forward([
            'controller' => 'index',
            'action'     => 'index',
        ]);
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function registerSession(Users $user): void
    {
        $this->session->set('auth', [
            'id'   => $user->id,
            'name' => $user->name,
        ]);
    }
}
