<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Forms;

use Invo\Forms\LoginForm;
use Phalcon\Forms\Form;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class LoginFormTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(LoginForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }
}
