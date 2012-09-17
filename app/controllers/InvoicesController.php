<?php

use Phalcon\Tag as Tag;
use Phalcon\Flash as Flash;
use Phalcon\Session as Session;

class InvoicesController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Tag::setTitle('Manage your Invoices');
        parent::initialize();
    }

    public function indexAction()
    {
    }

    /**
     * Edit the active user profile
     *
     */
    public function profileAction()
    {
        //Get session info
        $auth = $this->session->get('auth');

        //Query the active user
        $user = Users::findFirst($auth['id']);
        if ($user == false) {
            $this->_forward('index/index');
        }

        $request = $this->request;

        if (!$request->isPost()) {
            Tag::setDefault('name', $user->name);
            Tag::setDefault('email', $user->email);
        } else {

            $name = $request->getPost('name', 'string');
            $email = $request->getPost('email', 'email');

            $name = strip_tags($name);

            $user->name = $name;
            $user->email = $email;
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->flash->success('Your profile information was updated successfully');
            }
        }
    }
}
