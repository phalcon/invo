<?php

declare(strict_types=1);

use Dotenv\Dotenv;

Dotenv::createImmutable(dirname(__DIR__))
      ->load()
;

return [
    'database' => [
        'adapter'  => $_ENV['DB_ADAPTER']  ?? 'Mysql',
        'host'     => $_ENV['DB_HOST']     ?? 'localhost',
        'port'     => $_ENV['DB_PORT']     ?? 3306,
        'username' => $_ENV['DB_USERNAME'] ?? 'phalcon',
        'password' => $_ENV['DB_PASSWORD'] ?? 'secret',
        'dbname'   => $_ENV['DB_DBNAME']   ?? 'phalcon_invo',
    ],
    'application' => [
        'migrationsDir'        => 'resources/migrations',
        'logInDb'              => true,
        'exportDataFromTables' => [
            'companies',
            'product_types',
            'products',
            'users',
        ],
    ],
];
