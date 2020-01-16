<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Forms;

use Codeception\Test\Unit;
use Invo\Forms\ContactForm;
use Phalcon\Forms\Form;

final class ContactFormTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ContactForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }
}
