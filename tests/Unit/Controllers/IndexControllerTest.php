<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Invo\Controllers\IndexController;
use Phalcon\Mvc\Controller;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class IndexControllerTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(IndexController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
