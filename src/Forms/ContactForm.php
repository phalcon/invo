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

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class ContactForm extends Form
{
    /**
     * @param null $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = [])
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
         * Email field
         */
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf(['message' => 'E-mail is required']),
            new Email(['message' => 'E-mail is not valid'])
        ]);

        $this->add($email);

        /**
         * Comment textarea
         */
        $comments = new TextArea('comments');
        $comments->setLabel('Comments');
        $comments->setFilters(['striptags', 'string']);
        $comments->addValidators([
            new PresenceOf(['message' => 'Comments is required']),
        ]);

        $this->add($comments);
    }
}
