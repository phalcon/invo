<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Invo\Providers\FlashProvider;
use Phalcon\Di\ServiceProviderInterface;

final class FlashProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(FlashProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
