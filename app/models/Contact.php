<?php

use Phalcon\Mvc\Model;
use Phalcon\Db\RawValue;

class Contact extends Model
{
	public $id;

	public $name;

	public $email;

	public $comments;

	public $created_at;

	public function beforeCreate()
	{
		$this->created_at = new RawValue('now()');
	}
}
