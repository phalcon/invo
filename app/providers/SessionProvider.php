<?php
declare(strict_types=1);

namespace Invo\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Start the session the first time some component request the session service
 */
final class SessionProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $di->setShared('session', function () {
            $session = new SessionAdapter();
            $session->start();
            return $session;
        });
    }
}
