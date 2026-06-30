<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Invo\Controllers\ProducttypesController;
use Phalcon\Mvc\Controller;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ProductTypesControllerTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(ProducttypesController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
