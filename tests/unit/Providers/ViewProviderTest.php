<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Invo\Providers\ViewProvider;
use Phalcon\Di\ServiceProviderInterface;

final class ViewProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ViewProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
