<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Invo\Models\Products;
use Phalcon\Mvc\Model;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ProductsTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(Products::class);

        $this->assertInstanceOf(Model::class, $class);
    }
}
