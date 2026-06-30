<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Invo\Models\Companies;
use Phalcon\Mvc\Model;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class CompaniesTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(Companies::class);

        $this->assertInstanceOf(Model::class, $class);
    }
}
