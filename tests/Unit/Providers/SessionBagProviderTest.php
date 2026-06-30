<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Invo\Providers\SessionBagProvider;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class SessionBagProviderTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(SessionBagProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
