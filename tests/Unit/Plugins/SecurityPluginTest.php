<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Plugins;

use Invo\Plugins\SecurityPlugin;
use Phalcon\Di\Injectable;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class SecurityPluginTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(SecurityPlugin::class);

        $this->assertInstanceOf(Injectable::class, $class);
    }
}
