<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Invo\Providers\SessionBagProvider;
use Phalcon\Di\ServiceProviderInterface;

final class SessionBagProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(SessionBagProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
