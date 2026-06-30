<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Plugins;

use Invo\Plugins\SecurityPlugin;
use Phalcon\Di\Di;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Session\ManagerInterface;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;
use stdClass;

final class SecurityPluginTest extends AbstractUnitTestCase
{
    public function testForwardsTo401WhenNotAllowed(): void
    {
        $session = $this->createMock(ManagerInterface::class);
        $session->method('get')->willReturn(null);
        $session->expects($this->once())->method('destroy');

        $dispatcher = new Dispatcher();
        $dispatcher->setControllerName('companies');
        $dispatcher->setActionName('index');

        $plugin = $this->buildPlugin($session);
        $result = $plugin->beforeExecuteRoute(
            new Event('dispatch:beforeExecuteRoute', $dispatcher),
            $dispatcher
        );

        $this->assertFalse($result);
        $this->assertSame('errors', $dispatcher->getControllerName());
        $this->assertSame('show401', $dispatcher->getActionName());
    }

    public function testForwardsTo404WhenComponentMissing(): void
    {
        $session = $this->createMock(ManagerInterface::class);
        $session->method('get')->willReturn(null);

        $dispatcher = new Dispatcher();
        $dispatcher->setControllerName('nonexistent');
        $dispatcher->setActionName('index');

        $plugin = $this->buildPlugin($session);
        $result = $plugin->beforeExecuteRoute(
            new Event('dispatch:beforeExecuteRoute', $dispatcher),
            $dispatcher
        );

        $this->assertFalse($result);
        $this->assertSame('errors', $dispatcher->getControllerName());
        $this->assertSame('show404', $dispatcher->getActionName());
    }

    public function testGrantsAccessWhenAllowed(): void
    {
        $session = $this->createMock(ManagerInterface::class);
        $session->method('get')->willReturn(['id' => 1, 'name' => 'Demo']);

        $dispatcher = new Dispatcher();
        $dispatcher->setControllerName('companies');
        $dispatcher->setActionName('index');

        $plugin = $this->buildPlugin($session);
        $result = $plugin->beforeExecuteRoute(
            new Event('dispatch:beforeExecuteRoute', $dispatcher),
            $dispatcher
        );

        $this->assertTrue($result);
        $this->assertSame('companies', $dispatcher->getControllerName());
    }

    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(SecurityPlugin::class);

        $this->assertInstanceOf(Injectable::class, $class);
    }

    private function buildPlugin(ManagerInterface $session): SecurityPlugin
    {
        $di = new Di();
        $di->setShared('session', $session);
        // Injectable::$persistent resolves through the "sessionBag" service; a
        // plain object is enough for getAcl() to cache the built ACL on.
        $di->setShared('sessionBag', fn ($className = null) => new stdClass());

        $plugin = new SecurityPlugin();
        $plugin->setDI($di);

        return $plugin;
    }
}
