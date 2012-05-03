<?php

use Phalcon_Tag as Tag;
use Phalcon_Flash as Flash;

class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Tag::setTitle('Sign Up/Sign In');
        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            Tag::setDefault('email', 'demo@phalconphp.com');
            Tag::setDefault('password', 'phalcon');
        }
    }

    public function registerAction()
    {
        if ($this->request->isPost()) {

            $name = $this->request->getPost('name', 'string');
            $username = $this->request->getPost('username', 'string');
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');

            if ($password != $repeatPassword) {
                Flash::error((string) $message, 'alert alert-error');
                return false;
            }

            $name = strip_tags($name);
            $username = strip_tags($username);

            $user = new Users();
            $user->username = $username;
            $user->password = sha1($password);
            $user->name = $name;
            $user->email = $email;
            $user->created_at = new Phalcon_Db_RawValue('now()');
            $user->active = 'Y';
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    Flash::error((string) $message, 'alert alert-error');
                }
            } else {
                Tag::setDefault('email', '');
                Tag::setDefault('password', '');
                Flash::success('Thanks for sign-up, please log-in to start generating invoices', 'alert alert-success');
                return $this->_forward('session/index');
            }
        }
    }

    /**
     * Register authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession($user)
    {
        Phalcon_Session::set('auth', array(
            'id' => $user->id,
            'name' => $user->name
        ));
    }

    /**
     * This actions receive the input from the login form
     *
     */
    public function startAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');

            $password = sha1($password);

            $user = Users::findFirst("email='$email' AND password='$password' AND active='Y'");
            if ($user != false) {
                $this->_registerSession($user);
                Flash::success('Welcome ' . $user->name, 'alert alert-success');
                return $this->_forward('invoices/index');
            }

            $username = $this->request->getPost('email', 'string');
            $user = Users::findFirst("username='$email' AND password='$password' AND active='Y'");
            if ($user != false) {
                $this->_registerSession($user);
                Flash::success('Welcome ' . $user->name, 'alert alert-success');
                return $this->_forward('invoices/index');
            }

            Flash::error('Wrong email/password', 'alert alert-error');
        }

        return $this->_forward('session/index');
    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
        unset($_SESSION['auth']);
        Flash::success('Goodbye!', 'alert alert-success');

        return $this->_forward('index/index');
    }
}
