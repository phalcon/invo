<?php
declare(strict_types=1);

namespace Invo\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Session\Manager as SessionManager;

/**
 * Start the session the first time some component request the session service
 */
final class SessionProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $di->setShared('session', function () {
            $session = new SessionManager();
            $files = new SessionAdapter([
                'savePath' => sys_get_temp_dir(),
            ]);
            $session->setAdapter($files);

            return $session;
        });
    }
}
