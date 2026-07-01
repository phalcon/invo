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

namespace Invo\Forms;

use Invo\Models\ProductTypes;
use Phalcon\Filter\Validation\Validator\Numericality;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;

class ProductsForm extends Form
{
    use IdAndNameFieldsTrait;

    /**
     * Initialize the products form
     *
     * @param null  $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = [])
    {
        $this->addIdAndNameFields($options);

        /**
         * Product Type Id Select
         */
        $type = new Select(
            'product_types_id',
            ProductTypes::find(),
            [
                'using'      => ['id', 'name'],
                'useEmpty'   => true,
                'emptyText'  => '...',
                'emptyValue' => '',
            ]
        );
        $type->setLabel('Type');

        $this->add($type);

        /**
         * Price text field
         */
        $price = new Text('price');
        $price->setLabel('Price');
        $price->setFilters(['float']);
        $price->addValidators([
            new PresenceOf(['message' => 'Price is required']),
            new Numericality(['message' => 'Price is required']),
        ]);

        $this->add($price);
    }
}
