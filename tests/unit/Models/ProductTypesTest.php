<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Codeception\Test\Unit;
use Invo\Models\ProductTypes;
use Phalcon\Mvc\Model;

final class ProductTypesTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ProductTypes::class);

        $this->assertInstanceOf(Model::class, $class);
    }
}
