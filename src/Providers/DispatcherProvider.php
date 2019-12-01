<?php
declare(strict_types=1);

namespace Invo\Providers;

use Invo\Plugins\NotFoundPlugin;
use Invo\Plugins\SecurityPlugin;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;

/**
 * We register the events manager
 */
final class DispatcherProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $di->setShared('dispatcher', function () {
            $eventsManager = new EventsManager();

            /**
             * Check if the user is allowed to access certain action using the SecurityPlugin
             */
            $eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);

            /**
             * Handle exceptions and not-found exceptions using NotFoundPlugin
             */
            $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Invo\Controllers');
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });
    }
}
