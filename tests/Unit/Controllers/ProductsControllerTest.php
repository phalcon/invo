<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Invo\Controllers\ProductsController;
use Phalcon\Mvc\Controller;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ProductsControllerTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(ProductsController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
