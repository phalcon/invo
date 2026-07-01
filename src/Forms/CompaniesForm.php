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

use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;

class CompaniesForm extends Form
{
    use IdAndNameFieldsTrait;

    /**
     * Initialize the companies form
     *
     * @param null  $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = [])
    {
        $this->addIdAndNameFields($options);

        $commonFilters = [
            'striptags',
            'string',
        ];

        /**
         * Telephone text field
         */
        $telephone = new Text('telephone');
        $telephone->setLabel('Telephone');
        $telephone->setFilters($commonFilters);
        $telephone->addValidators([
            new PresenceOf(['message' => 'Telephone is required']),
        ]);

        $this->add($telephone);

        /**
         * Address text field
         */
        $address = new Text('address');
        $address->setLabel('address');
        $address->setFilters($commonFilters);
        $address->addValidators([
            new PresenceOf(['message' => 'Address is required']),
        ]);

        $this->add($address);

        /**
         * City text field
         */
        $city = new Text('city');
        $city->setLabel('city');
        $city->setFilters($commonFilters);
        $city->addValidators([
            new PresenceOf(['message' => 'City is required']),
        ]);

        $this->add($city);
    }
}
