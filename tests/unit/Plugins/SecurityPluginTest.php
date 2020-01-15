<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Plugins;

use Codeception\Test\Unit;
use Invo\Plugins\SecurityPlugin;
use Phalcon\Di\Injectable;

final class SecurityPluginTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(SecurityPlugin::class);

        $this->assertInstanceOf(Injectable::class, $class);
    }
}
