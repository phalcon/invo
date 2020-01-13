<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Codeception\Test\Unit;
use Invo\Models\Products;
use Phalcon\Mvc\Model;

final class ProductsTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(Products::class);

        $this->assertInstanceOf(Model::class, $class);
    }
}
