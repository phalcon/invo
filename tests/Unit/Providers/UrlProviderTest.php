<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Invo\Providers\UrlProvider;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class UrlProviderTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(UrlProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
