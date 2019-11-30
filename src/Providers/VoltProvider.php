<?php
declare(strict_types=1);

namespace Invo\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

final class VoltProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $view = $di->getShared('view');

        $di->setShared('volt', function () use ($view, $di) {
            $volt = new VoltEngine($view, $di);
            $volt->setOptions([
                'compiledPath' => $di->offsetGet('rootPath') . '/cache/volt/',
            ]);

            $compiler = $volt->getCompiler();
            $compiler->addFunction('is_a', 'is_a');

            return $volt;
        });
    }
}
