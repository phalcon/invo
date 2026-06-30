<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Forms;

use Invo\Forms\ContactForm;
use Phalcon\Forms\Form;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ContactFormTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(ContactForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }
}
