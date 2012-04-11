<?php

use Phalcon_Tag as Tag;
use Phalcon_Flash as Flash;
use Phalcon_Session as Session;

class InvoicesController extends ControllerBase {

	public function initialize(){
		$this->view->setTemplateAfter('main');
		Tag::setTitle('Manage your Invoices');
		parent::initialize();
	}

	public function beforeDispatch(){
		if(!Session::get('auth')){
			Flash::error('You don\'t have access to this module', 'alert alert-error');
			$this->_forward('index/index');
		}
	}

	public function indexAction(){

	}

	/**
	 * Edit the active user profile
	 *
	 */
	public function profileAction(){

		//Get session info
		$auth = Session::get('auth');

		//Query the active user
		$user = Users::findFirst($auth['id']);
		if($user==false){
			$this->_forward('index/index');
		}

		if(!$this->request->isPost()){
			Tag::setDefault('name', $user->name);
			Tag::setDefault('email', $user->email);
		} else {

			$name = $this->request->getPost('name', 'string');
			$email = $this->request->getPost('email', 'email');

			$name = strip_tags($name);

			$user->name = $name;
			$user->email = $email;
			if($user->save()==false){
				foreach($user->getMessages() as $message){
					Flash::error((string) $message, 'alert alert-error');
				}
			} else {
				Flash::success('Your profile information was updated successfully', 'alert alert-success');
			}
		}

	}

}

