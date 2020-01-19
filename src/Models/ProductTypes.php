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
        $this->hasMany(
            'id',
            Products::class,
            'product_types_id',
            [
                'foreignKey' => [
                    'message' => 'Product Type cannot be deleted because it\'s used in Products'
                ],
            ]
        );
    }
}
