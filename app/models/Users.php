<?php

use Phalcon\Mvc\Model\Validator\Email as EmailValidator;

class Users extends Phalcon\Mvc\Model
{
    public function validation()
    {
        $this->validate(new EmailEmailValidator(array(
            'field' => 'email'
        )));
        /*$this->validate('Uniqueness', array(
            'field' => 'email',
            'message' => 'Sorry, The email was registered by another user'
        ));
        $this->validate('Uniqueness', array(
            'field' => 'username',
            'message' => 'Sorry, That username is already taken'
        ));*/
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
