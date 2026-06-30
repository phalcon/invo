<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Invo\Models\Users;
use Phalcon\Mvc\Model;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class UsersTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(Users::class);

        $this->assertInstanceOf(Model::class, $class);
    }
}
