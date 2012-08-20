<?php

use Phalcon\Model\Base as Model;

class Users extends Model
{
    public function validation()
    {
        $this->validate('Email', array(
            'field' => 'email'
        ));
        $this->validate('Uniqueness', array(
            'field' => 'email',
            'message' => 'Sorry, The email was registered by another user'
        ));
        $this->validate('Uniqueness', array(
            'field' => 'username',
            'message' => 'Sorry, That username is already taken'
        ));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
