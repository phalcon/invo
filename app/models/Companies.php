<?php

use Phalcon\Model\Base as Model;

class Companies extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $telephone;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $city;
}
