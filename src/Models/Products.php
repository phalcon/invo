<?php
declare(strict_types=1);

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Invo\Models;

use Phalcon\Mvc\Model;

/**
 * Products
 */
class Products extends Model
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
            ]
        );
    }

    /**
     * Returns a human representation of 'active'
     *
     * @return string
     */
    public function getActiveDetail(): string
    {
        return $this->active == 'Y' ? 'Yes' : 'No';
    }
}
