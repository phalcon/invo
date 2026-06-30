<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Invo\Constants\Status;
use Invo\Models\Products;
use Phalcon\Di\Di;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ProductsTest extends AbstractUnitTestCase
{
    public function testGetActiveDetailReturnsNoWhenInactive(): void
    {
        $product         = $this->makeProduct();
        $product->active = Status::INACTIVE;

        $this->assertSame('No', $product->getActiveDetail());
    }

    public function testGetActiveDetailReturnsYesWhenActive(): void
    {
        $product         = $this->makeProduct();
        $product->active = Status::ACTIVE;

        $this->assertSame('Yes', $product->getActiveDetail());
    }

    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(Products::class);

        $this->assertInstanceOf(Model::class, $class);
    }

    private function makeProduct(): Products
    {
        $di                  = new Di();
        $di['modelsManager'] = function () {
            return new Manager();
        };

        $product = new Products();
        $product->setDI($di);

        return $product;
    }
}
