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

use Invo\Plugins\ElementsPlugin;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Register a menu
 */
final class ElementsProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $di->setShared('elements', function () {
            return new ElementsPlugin();
        });
    }
}
