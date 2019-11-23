<?php
declare(strict_types=1);

namespace Invo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;

class ProductTypesForm extends Form
{
    /**
     * Initialize the products form
     */
    public function initialize($entity = null, array $options = [])
    {
        if (!isset($options['edit'])) {
            $element = new Text("id");
            $this->add(
                $element->setLabel("Id")
            );
        } else {
            $this->add(
                new Hidden("id")
            );
        }

        $name = new Text("name");
        $name->setLabel("Name");
        $name->setFilters(['striptags', 'string']);
        $name->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'Name is required',
                    ]
                ),
            ]
        );
        $this->add($name);
    }
}
