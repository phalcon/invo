<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Invo\Providers\UrlProvider;
use Phalcon\Di\ServiceProviderInterface;

final class UrlProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(UrlProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
