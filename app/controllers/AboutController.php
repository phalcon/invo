<?php

class AboutController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon_Tag::setTitle('About us');
        parent::initialize();
    }

    public function indexAction()
    {
    }
}
