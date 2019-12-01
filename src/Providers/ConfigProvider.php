<?php
declare(strict_types=1);

namespace Invo\Providers;

use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Read the configuration
 */
final class ConfigProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $rootPath = $di->offsetGet('rootPath');
        $di->setShared('config', function () use ($rootPath) {
            $config = new ConfigIni($rootPath . '/src/config/config.ini');

            if (is_readable($rootPath . '/src/config/config.ini.dev')) {
                $override = new ConfigIni($rootPath . '/src/config/config.ini.dev');
                $config->merge($override);
            }

            return $config;
        });
    }
}
