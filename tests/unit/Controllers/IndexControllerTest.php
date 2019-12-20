<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Invo\Controllers\IndexController;
use Phalcon\Mvc\Controller;

final class IndexControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(IndexController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
