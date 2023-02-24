<?php

declare(strict_types=1);

namespace unit\Forms;

use Codeception\Test\Unit;
use Invo\Forms\LoginForm;
use Phalcon\Forms\Form;

final class LoginFormTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(LoginForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }
}
