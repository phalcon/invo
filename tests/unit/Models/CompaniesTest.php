<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Codeception\Test\Unit;
use Invo\Models\Companies;
use Phalcon\Mvc\Model;

final class CompaniesTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(Companies::class);

        $this->assertInstanceOf(Model::class, $class);
    }
}
