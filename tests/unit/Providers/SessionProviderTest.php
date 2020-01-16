<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Invo\Providers\SessionProvider;
use Phalcon\Di\ServiceProviderInterface;

final class SessionProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(SessionProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
