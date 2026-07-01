<?php

use Phalcon\Migrations\Db\Column;
use Phalcon\Migrations\Db\Index;
use Phalcon\Migrations\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class UsersMigration_101
 */
class UsersMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('users', [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 10,
                        'first' => true
                    ]
                ),
                new Column(
                    'username',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'password',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 255,
                        'after' => 'username'
                    ]
                ),
                new Column(
                    'name',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 120,
                        'after' => 'password'
                    ]
                ),
                new Column(
                    'email',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 70,
                        'after' => 'name'
                    ]
                ),
                new Column(
                    'created_at',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'notNull' => true,
                        'after' => 'email'
                    ]
                ),
                new Column(
                    'active',
                    [
                        'type' => Column::TYPE_TINYINTEGER,
                        'default' => "0",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'created_at'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY KEY'),
            ],
            'options' => [
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8mb3_unicode_ci',
                'AUTO_INCREMENT' => '2',
            ],
        ]);
    }

    /**
     * Run the migrations
     *
     * The users table already exists with data as of 1.0.0 - this migration
     * only widens the password column (see morph()) and re-hashes the demo
     * user's password to match, rather than re-inserting rows that are
     * already there.
     *
     * @return void
     */
    public function up(): void
    {
        $this->getConnection()->execute(
            'UPDATE users SET password = ? WHERE username = ?',
            ['$2y$10$2iPUdY1zwrv45DTB04h6eeWFg63gnnayLX.UIVMU/9ds1Hs2BDuZq', 'demo']
        );
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down(): void
    {
        $this->batchDelete('users');
    }
}
