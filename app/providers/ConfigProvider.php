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
        $di->setShared('config', function () {
            $config = new ConfigIni(APP_PATH . 'app/config/config.ini');

            if (is_readable(APP_PATH . 'app/config/config.ini.dev')) {
                $override = new ConfigIni(
                    APP_PATH . 'app/config/config.ini.dev'
                );

                $config->merge($override);
            }

            return $config;
        });
    }
}
