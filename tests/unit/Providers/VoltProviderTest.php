<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Invo\Providers\VoltProvider;
use Phalcon\Di\ServiceProviderInterface;

final class VoltProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(VoltProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
