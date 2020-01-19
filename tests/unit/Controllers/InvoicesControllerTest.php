<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Invo\Controllers\InvoicesController;
use Phalcon\Mvc\Controller;

final class InvoicesControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(InvoicesController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
