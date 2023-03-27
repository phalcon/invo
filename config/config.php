<?php
declare(strict_types=1);

use Phalcon\Config\Config;

return new Config([
    'database' => [
        'adapter'  => $_ENV['DB_ADAPTER'] ?? 'Mysql',
        'host'     => $_ENV['DB_HOST'] ?? 'localhost',
        'username' => $_ENV['DB_USERNAME'] ?? 'phalcon',
        'password' => $_ENV['DB_PASSWORD'] ?? 'secret',
        'dbname'   => $_ENV['DB_DBNAME'] ?? 'phalcon_invo',
        'charset'  => $_ENV['DB_CHARSET'] ?? 'utf8',
        'options' => [
            PDO::ATTR_EMULATE_PREPARES => true
        ]
    ],
    'application' => [
        'viewsDir' => $_ENV['VIEWS_DIR'] ?? 'themes/invo',
        'baseUri'  => $_ENV['BASE_URI'] ?? '/',
    ],
]);
