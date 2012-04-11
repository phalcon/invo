<?php

class ControllerBase extends Phalcon_Controller {

	public function initialize(){
		Phalcon_Session::start();
		Phalcon_Tag::prependTitle('INVO | ');
	}

}
