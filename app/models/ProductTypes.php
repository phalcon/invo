<?php

use Phalcon\Mvc\Model;

/**
 * Types of Products
 */
class ProductTypes extends Model
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
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->hasMany('id', 'Products', 'product_types_id', [
        	'foreignKey' => [
        		'message' => 'Product Type cannot be deleted because it\'s used in Products'
        	]
        ]);
    }
}
