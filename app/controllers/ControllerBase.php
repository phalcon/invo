<?php

class ControllerBase extends Phalcon\Controller
{
    public function initialize()
    {
        Phalcon\Tag::prependTitle('INVO | ');
    }
}
