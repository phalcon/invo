<?php
declare(strict_types=1);

use Dotenv\Dotenv;
use Phalcon\Config;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

return new Config([
    'database' => [
        'adapter' => getenv('DB_ADAPTER'),
        'host' => getenv('DB_HOST'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'dbname' => getenv('DB_DBNAME'),
        'charset' => getenv('DB_CHARSET'),
    ],
]);
