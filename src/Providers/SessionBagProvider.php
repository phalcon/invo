<?php

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Invo\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Session\Bag;

class SessionBagProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $session = $di->getShared('session');
        $di->setShared(
            'sessionBag',
            function () use ($session) {
                return new Bag($session, 'bag');
            }
        );
    }
}
