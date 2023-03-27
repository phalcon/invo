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

use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;

class RegisterForm extends Form
{
    /**
     * @param null $entity
     * @param null $options
     */
    public function initialize($entity = null, $options = null)
    {
        /**
         * Name text field
         */
        $name = new Text('name');
        $name->setLabel('Your Full Name');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf(['message' => 'Name is required']),
        ]);

        $this->add($name);

        /**
         * Username text field
         */
        $name = new Text('username');
        $name->setLabel('Username');
        $name->setFilters(['alphanum']);
        $name->addValidators([
            new PresenceOf(['message' => 'Please enter your desired user name']),
            new UniquenessValidator(
                [
                    'message' => 'Sorry, That username is already taken',
                ]
            )
        ]);

        $this->add($name);

        /**
         * Email text field
         */
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf(['message' => 'E-mail is required']),
            new Email(['message' => 'E-mail is not valid']),
            new UniquenessValidator(
                [
                    'message' => 'Sorry, The email was registered by another user',
                ]
            )
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

        /**
         * Confirm Password field
         */
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Repeat Password');
        $repeatPassword->addValidators([
            new PresenceOf(['message' => 'Confirmation password is required']),
        ]);

        $this->add($repeatPassword);
    }
}
