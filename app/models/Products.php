<?php

class Products extends Phalcon\Mvc\Model
{
	/**
	 * @var integer
	 */
	public $id;

	/**
	 * @var integer
	 */
	public $product_types_id;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $price;

	/**
	 * @var string
	 */
	public $active;

	public function initialize()
	{
		$this->belongsTo('product_types_id', 'ProductTypes', 'id', array(
			'reusable' => true
		));
	}

}
