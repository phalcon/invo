<?php
declare(strict_types=1);

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Invo\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Session\Manager as SessionManager;

/**
 * Start the session the first time some component request the session service
 */
class SessionProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $di->setShared('session', function () {
            $session = new SessionManager();
            $files = new SessionAdapter([
                'savePath' => sys_get_temp_dir(),
            ]);
            $session->setAdapter($files);
            $session->start();

            return $session;
        });
    }
}
