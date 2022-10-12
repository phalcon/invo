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

use Phalcon\Filter\Validation;
use Phalcon\Filter\Validation\Validator\Email as EmailValidator;
use Phalcon\Filter\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model;

class Users extends Model
{
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'message' => 'Invalid email given',
                ]
            )
        );
        $validator->add(
            'email',
            new UniquenessValidator(
                [
                    'message' => 'Sorry, The email was registered by another user',
                ]
            )
        );
        $validator->add(
            'username',
            new UniquenessValidator(
                [
                    'message' => 'Sorry, That username is already taken',
                ]
            )
        );

        return $this->validate($validator);
    }
}
