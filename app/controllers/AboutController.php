<?php

class AboutController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        $this->tag->setTitle('About us');
        parent::initialize();
    }

    public function indexAction()
    {
    }
}
