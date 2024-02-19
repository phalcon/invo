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
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;

class LoginForm extends Form
{
    /**
     */
    public function initialize()
    {
        /**
         * Username/Email text field
         */
        $email = new Text('email');
        $email->setLabel('Username/Email');
        $email->setFilters(['striptags', 'string']);
        $email->addValidators([
            new PresenceOf(['message' => 'Username/Email is required']),
        ]);

        $this->add($email);

        /**
         * Password field
         */
        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators([
            new PresenceOf(['message' => 'Password is required']),
        ]);

        $this->add($password);
    }
}
