<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Invo\Providers\ViewProvider;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ViewProviderTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(ViewProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
