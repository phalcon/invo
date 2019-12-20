<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Invo\Controllers\ProductsController;
use Phalcon\Mvc\Controller;

final class ProductsControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ProductsController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
