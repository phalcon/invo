<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Invo\Providers\DispatcherProvider;
use Phalcon\Di\ServiceProviderInterface;

final class DispatcherProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(DispatcherProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
