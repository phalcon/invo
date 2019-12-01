<?php
declare(strict_types=1);

namespace Invo\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Session\Bag;

final class SessionBagProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $di->setShared('sessionBag', function () {
            return new Bag('bag');
        });
    }
}
