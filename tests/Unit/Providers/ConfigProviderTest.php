<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Exception;
use Invo\Providers\ConfigProvider;
use Phalcon\Di\FactoryDefault;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ConfigProviderTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(ConfigProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }

    public function testThrowsWhenConfigFileMissing(): void
    {
        $di = new FactoryDefault();
        $di->offsetSet('rootPath', function () {
            return '/nonexistent-invo-root';
        });

        $this->expectException(Exception::class);

        (new ConfigProvider())->register($di);
    }
}
