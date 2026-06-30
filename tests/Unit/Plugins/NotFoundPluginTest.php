<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Plugins;

use Invo\Plugins\NotFoundPlugin;
use Phalcon\Di\Injectable;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class NotFoundPluginTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(NotFoundPlugin::class);

        $this->assertInstanceOf(Injectable::class, $class);
    }
}
