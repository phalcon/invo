<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Invo\Controllers\ProducttypesController;
use Phalcon\Mvc\Controller;

final class ProductTypesControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ProducttypesController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
