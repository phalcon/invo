<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Invo\Controllers\AboutController;
use Phalcon\Mvc\Controller;

final class AboutControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(AboutController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
