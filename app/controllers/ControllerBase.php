<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function initialize()
    {
        $this->tag->prependTitle('INVO | ');
        $this->view->setTemplateAfter('main');
    }

    protected function forward($uri)
    {
        return $this->response->redirect($uri);
    }
}
