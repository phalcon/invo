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
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

class VoltProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $view = $di->getShared('view');

        $di->setShared('volt', function () use ($view, $di) {
            $volt = new VoltEngine($view, $di);
            $volt->setOptions([
                'path' => $di->offsetGet('rootPath') . '/var/cache/volt/',
            ]);

            $compiler = $volt->getCompiler();
            $compiler->addFunction('is_a', 'is_a');

            return $volt;
        });
    }
}
