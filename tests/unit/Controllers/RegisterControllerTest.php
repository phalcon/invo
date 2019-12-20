<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Invo\Controllers\RegisterController;
use Phalcon\Mvc\Controller;

final class RegisterControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(RegisterController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
