<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Invo\Models\ProductTypes;
use Phalcon\Mvc\Model;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ProductTypesTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(ProductTypes::class);

        $this->assertInstanceOf(Model::class, $class);
    }
}
