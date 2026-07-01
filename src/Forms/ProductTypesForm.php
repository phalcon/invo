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

use Phalcon\Forms\Form;

class ProductTypesForm extends Form
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
    }
}
