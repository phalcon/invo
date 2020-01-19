<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Forms;

use Codeception\Test\Unit;
use Invo\Forms\RegisterForm;
use Phalcon\Forms\Form;

final class RegisterFormTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(RegisterForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }
}
