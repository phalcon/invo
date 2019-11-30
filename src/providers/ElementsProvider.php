<?php
declare(strict_types=1);

namespace Invo\Providers;

use Invo\Plugins\ElementsPlugin;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Register a menu
 */
final class ElementsProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $di->setShared('elements', function () {
            return new ElementsPlugin();
        });
    }
}
