<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Application;

try {
    define('APP_PATH', realpath('..') . '/');

    $di = new FactoryDefault();

    $providersConfig = APP_PATH . '/app/config/providers.php';
    if (!file_exists($providersConfig) || !is_readable($providersConfig)) {
        throw new Exception('File providers.php does not exist or is not readable.');
    }

    $providers = include_once $providersConfig;
    foreach ($providers as $providerClass) {
        /** @var ServiceProviderInterface $provider */
        $provider = new $providerClass;
        $provider->register($di);
    }

    (new Application($di))
        ->handle($_SERVER['REQUEST_URI'])
        ->send();
} catch (Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
