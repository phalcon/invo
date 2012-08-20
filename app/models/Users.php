<?php

class Users extends Phalcon_Model_Base
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
