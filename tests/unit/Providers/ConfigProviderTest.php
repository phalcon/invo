<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Invo\Providers\ConfigProvider;
use Phalcon\Di\ServiceProviderInterface;

final class ConfigProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ConfigProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
