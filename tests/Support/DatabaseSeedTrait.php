<?php

declare(strict_types=1);

namespace Invo\Tests\Support;

use PDO;

/**
 * Resets the database to a known fixture set between tests. The in-process browser
 * rebuilds the app (and its DB connection) per request, so transaction rollback cannot
 * isolate tests - state is reset by truncate + reseed instead. The fixtures mirror the
 * seed data shipped in resources/migrations/1.0.0.
 */
trait DatabaseSeedTrait
{
    private static ?PDO $seedPdo = null;

    public function pdo(): PDO
    {
        if (null === self::$seedPdo) {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8',
                (string) ($_ENV['DB_HOST'] ?? '127.0.0.1'),
                (string) ($_ENV['DB_PORT'] ?? '3306'),
                (string) ($_ENV['DB_NAME'] ?? 'invo')
            );

            self::$seedPdo = new PDO(
                $dsn,
                (string) ($_ENV['DB_USERNAME'] ?? 'root'),
                (string) ($_ENV['DB_PASSWORD'] ?? 'secret'),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }

        return self::$seedPdo;
    }

    public function reseedDatabase(): void
    {
        $pdo = $this->pdo();

        $tables = ['companies', 'contact', 'product_types', 'products', 'users'];

        $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
        foreach ($tables as $table) {
            $pdo->exec('TRUNCATE TABLE ' . $table);
        }

        $this->seedUsers($pdo);
        $this->seedCompanies($pdo);
        $this->seedProductTypes($pdo);
        $this->seedProducts($pdo);

        $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
    }

    private function seedCompanies(PDO $pdo): void
    {
        // id, name, telephone, address, city
        $rows = [
            [1, 'Acme', '31566564', 'Address', 'Hello'],
            [2, 'Acme Inc', '+44 564612345', 'Guildhall, PO Box 270, London', 'London'],
        ];

        $stmt = $pdo->prepare('INSERT INTO companies (id, name, telephone, address, city) VALUES (?, ?, ?, ?, ?)');
        foreach ($rows as $row) {
            $stmt->execute($row);
        }
    }

    private function seedProducts(PDO $pdo): void
    {
        // id, product_types_id, name, price, active
        $rows = [
            [1, 5, 'Artichoke', 10.50, 0],
            [2, 5, 'Bell pepper', 10.40, 0],
        ];

        $stmt = $pdo->prepare(
            'INSERT INTO products (id, product_types_id, name, price, active) VALUES (?, ?, ?, ?, ?)'
        );
        foreach ($rows as $row) {
            $stmt->execute($row);
        }
    }

    private function seedProductTypes(PDO $pdo): void
    {
        // id, name
        $rows = [
            [5, 'Vegetables'],
            [6, 'Fruits'],
        ];

        $stmt = $pdo->prepare('INSERT INTO product_types (id, name) VALUES (?, ?)');
        foreach ($rows as $row) {
            $stmt->execute($row);
        }
    }

    private function seedUsers(PDO $pdo): void
    {
        // id, username, password (bcrypt hash of "phalcon"), name, email, created_at, active
        $rows = [
            [
                1, 'demo', '$2y$10$2iPUdY1zwrv45DTB04h6eeWFg63gnnayLX.UIVMU/9ds1Hs2BDuZq',
                'Phalcon Demo', 'demo@phalcon.io', '2012-04-10 20:53:03', 1,
            ],
        ];

        $stmt = $pdo->prepare(
            'INSERT INTO users (id, username, password, name, email, created_at, active)'
            . ' VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        foreach ($rows as $row) {
            $stmt->execute($row);
        }
    }
}
