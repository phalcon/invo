<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Invo\Controllers\ErrorsController;
use Phalcon\Mvc\Controller;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ErrorsControllerTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(ErrorsController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
