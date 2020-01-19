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

namespace Invo\Forms;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;

class CompaniesForm extends Form
{
    /**
     * Initialize the companies form
     *
     * @param null $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = [])
    {
        if (!isset($options['edit'])) {
            $this->add((new Text('id'))->setLabel('Id'));
        } else {
            $this->add(new Hidden('id'));
        }

        $commonFilters = [
            'striptags',
            'string',
        ];

        /**
         * Name text field
         */
        $name = new Text('name');
        $name->setLabel('Name');
        $name->setFilters($commonFilters);
        $name->addValidators([
            new PresenceOf(['message' => 'Name is required']),
        ]);

        $this->add($name);

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
