<?php

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Invo\Models;

use Invo\Constants\Status;
use Phalcon\Mvc\Model;

/**
 * Products
 * @property ProductTypes $productType
 */
class Products extends Model
{
    /**
     * @var string
     */
    public $active;
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
    public $price;

    /**
     * @var integer
     */
    public $product_types_id;

    /**
     * Returns a human representation of 'active'
     *
     * @return string
     */
    public function getActiveDetail(): string
    {
        return $this->active == Status::ACTIVE ? 'Yes' : 'No';
    }

    /**
     * Products initializer
     */
    public function initialize()
    {
        $this->belongsTo(
            'product_types_id',
            ProductTypes::class,
            'id',
            [
                'reusable' => true,
                'alias' => 'productTypes',
            ]
        );
    }
}
