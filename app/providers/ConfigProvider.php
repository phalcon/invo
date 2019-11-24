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
    public function register(DiInterface $di)
    {
        $rootPath = $di->offsetGet('rootPath');
        $di->setShared('config', function () use ($rootPath) {
            $config = new ConfigIni($rootPath . '/app/config/config.ini');

            if (is_readable($rootPath . '/app/config/config.ini.dev')) {
                $override = new ConfigIni($rootPath . 'app/config/config.ini.dev');
                $config->merge($override);
            }

            return $config;
        });
    }
}
