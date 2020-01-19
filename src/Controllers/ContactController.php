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

use Invo\Forms\ContactForm;
use Invo\Models\Contact;

/**
 * ContactController
 *
 * Allows to contact the staff using a contact form
 */
class ContactController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Contact us');
    }

    public function indexAction(): void
    {
        $this->view->form = new ContactForm;
    }

    /**
     * Saves the contact information in the database
     */
    public function sendAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'contact',
                'action'     => 'index',
            ]);

            return;
        }

        $form = new ContactForm();
        $contact = new Contact();

        // Validate the form
        if (!$form->isValid($this->request->getPost(), $contact)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'contact',
                'action'     => 'index',
            ]);

            return;
        }

        if (!$contact->save()) {
            foreach ($contact->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'contact',
                'action'     => 'index',
            ]);

            return;
        }

        $this->flash->success('Thanks, we will contact you in the next few hours');

        $this->dispatcher->forward([
            'controller' => 'index',
            'action'     => 'index',
        ]);
    }
}
