<?php
declare(strict_types=1);

use Invo\Services;
use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;

try {
    define('APP_PATH', realpath('..') . '/');

    /**
     * Read the configuration
     */
    $config = new ConfigIni(APP_PATH . 'app/config/config.ini');

    if (is_readable(APP_PATH . 'app/config/config.ini.dev')) {
        $override = new ConfigIni(
            APP_PATH . 'app/config/config.ini.dev'
        );

        $config->merge($override);
    }

    /**
     * Auto-loader configuration
     */
    require APP_PATH . 'app/config/loader.php';

    $application = new Application(new Services($config));
    $application->handle($_SERVER['REQUEST_URI'])->send();
} catch (Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
