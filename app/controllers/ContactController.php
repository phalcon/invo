<?php

class ContactController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Contact us');
        parent::initialize();
    }

    public function indexAction()
    {
    }

    public function sendAction()
    {
        if ($this->request->isPost() == true) {

            $name = $this->request->getPost('name', 'string');
            $email = $this->request->getPost('email', 'email');
            $comments = $this->request->getPost('comments', 'string');

            $name = strip_tags($name);
            $comments = strip_tags($comments);

            $contact = new Contact();
            $contact->name = $name;
            $contact->email = $email;
            $contact->comments = $comments;
            $contact->created_at = new Phalcon\Db\RawValue('now()');
            if ($contact->save() == false) {
                foreach ($contact->getMessages() as $message) {
                    Phalcon\Flash::error((string) $message, 'alert alert-error');
                }                
            } else {
                Phalcon\Flash::success('Thanks, We will contact you in the next few hours', 'alert alert-success');
                return $this->forward('index/index');
            }
        } 
        return $this->forward('contact/index');        
    }
}
