<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Invo\Providers\FlashProvider;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class FlashProviderTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(FlashProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
