<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Invo\Controllers\ControllerBase;
use Phalcon\Mvc\Controller;

final class ControllerBaseTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ControllerBase::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
