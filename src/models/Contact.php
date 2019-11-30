<?php
declare(strict_types=1);

namespace Invo\Models;

use Phalcon\Db\RawValue;
use Phalcon\Mvc\Model;

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
