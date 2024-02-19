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
use Invo\Forms\RegisterForm;
use Invo\Models\Users;
use Phalcon\Db\RawValue;

/**
 * SessionController
 *
 * Allows to register new users
 */
class RegisterController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->title()
                  ->set('Sign Up/Sign In')
        ;

        parent::initialize();
    }

    /**
     * Action to register a new user
     */
    public function indexAction(): void
    {
        $form = new RegisterForm();

        if ($this->request->isPost()) {
            $newUser = new Users();
            if ($form->isValid($this->request->getPost(), $newUser)) {
                $newUser->password = sha1($form->getFilteredValue('password'));
                $newUser->created_at = new RawValue('now()');
                $newUser->active     = Status::ACTIVE;

                if ($newUser->save()) {
                    $this->flash->success(
                        'Thanks for sign-up, please log-in to start generating invoices'
                    );

                    $this->dispatcher->forward([
                        'controller' => 'session',
                        'action'     => 'index',
                    ]);

                    return;
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
