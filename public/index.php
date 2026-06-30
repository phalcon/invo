<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Invo\Application;

error_reporting(E_ALL);

$rootPath = dirname(__DIR__);

try {
    require_once $rootPath . '/vendor/autoload.php';

    Dotenv::createImmutable($rootPath)->load();

    echo (new Application($rootPath))->run();
} catch (Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
