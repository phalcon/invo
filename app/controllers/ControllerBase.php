<?php

class ControllerBase extends Phalcon_Controller
{
    public function initialize()
    {
        Phalcon_Tag::prependTitle('INVO | ');
    }
}
