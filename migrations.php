<?php
declare(strict_types=1);

use Dotenv\Dotenv;
use Phalcon\Config\Config;

Dotenv::createImmutable(__DIR__)
      ->load()
;

return new Config(
    [
        'database' => [
            'adapter'  => $_ENV['DB_ADAPTER'] ?? 'Mysql',
            'host'     => $_ENV['DB_HOST'] ?? 'localhost',
            'username' => $_ENV['DB_USERNAME'] ?? 'phalcon',
            'password' => $_ENV['DB_PASSWORD'] ?? 'secret',
            'dbname'   => $_ENV['DB_DBNAME'] ?? 'phalcon_invo',
            'charset'  => $_ENV['DB_CHARSET'] ?? 'utf8',
        ],
        'application' => [
            'logInDb'              => true,
            'migrationsDir'        => 'db/migrations',
            'exportDataFromTables' => [
                'companies',
                'product_types',
                'products',
                'users',
            ],
        ],
    ]
);
