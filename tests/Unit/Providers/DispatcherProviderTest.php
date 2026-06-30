<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Invo\Providers\DispatcherProvider;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class DispatcherProviderTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(DispatcherProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
