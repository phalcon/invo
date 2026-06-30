<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Invo\Controllers\SessionController;
use Phalcon\Mvc\Controller;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class SessionControllerTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(SessionController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
