<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Invo\Controllers\ProductTypesController;
use Phalcon\Mvc\Controller;

final class ProductTypesControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ProductTypesController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
