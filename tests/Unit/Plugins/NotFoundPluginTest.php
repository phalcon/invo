<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Plugins;

use Exception;
use Invo\Plugins\NotFoundPlugin;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class NotFoundPluginTest extends AbstractUnitTestCase
{
    public function testForwardsTo404OnHandlerNotFound(): void
    {
        $dispatcher = new Dispatcher();
        $dispatcher->setControllerName('products');
        $dispatcher->setActionName('missing');

        $exception = new DispatcherException(
            'not found',
            DispatcherException::EXCEPTION_HANDLER_NOT_FOUND
        );

        $plugin = new NotFoundPlugin();
        $result = $plugin->beforeException(
            new Event('dispatch:beforeException', $dispatcher),
            $dispatcher,
            $exception
        );

        $this->assertFalse($result);
        $this->assertSame('errors', $dispatcher->getControllerName());
        $this->assertSame('show404', $dispatcher->getActionName());
    }

    public function testForwardsTo500OnGenericException(): void
    {
        $dispatcher = new Dispatcher();
        $dispatcher->setControllerName('products');
        $dispatcher->setActionName('index');

        $plugin = new NotFoundPlugin();
        $result = $plugin->beforeException(
            new Event('dispatch:beforeException', $dispatcher),
            $dispatcher,
            new Exception('boom')
        );

        $this->assertTrue($result);
        $this->assertSame('errors', $dispatcher->getControllerName());
        $this->assertSame('show500', $dispatcher->getActionName());
    }

    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(NotFoundPlugin::class);

        $this->assertInstanceOf(Injectable::class, $class);
    }
}
