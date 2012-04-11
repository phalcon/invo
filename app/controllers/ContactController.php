<?php

class ContactController extends ControllerBase {

	public function initialize(){
		$this->view->setTemplateAfter('main');
		Phalcon_Tag::setTitle('Contact us');
		parent::initialize();
	}

	public function indexAction(){

	}

	public function sendAction(){

		if($this->request->isPost()==true){

			$name = $this->request->getPost('name', 'string');
			$email = $this->request->getPost('email', 'email');
			$comments = $this->request->getPost('comments', 'string');

			$name = strip_tags($name);
			$comments = strip_tags($comments);

			$contact = new Contact();
			$contact->name = $name;
			$contact->email = $email;
			$contact->comments = $comments;
			$contact->created_at = new Phalcon_Db_RawValue('now()');
			if($contact->save()==false){
				foreach($contact->getMessages() as $message){
					Phalcon_Flash::error((string) $message, 'alert alert-error');
				}
				return $this->_forward('contact/index');
			} else {
				Phalcon_Flash::success('Thanks, We will contact you in the next few hours', 'alert alert-success');
				return $this->_forward('index/index');
			}

		} else {
			return $this->_forward('contact/index');
		}

	}

}

