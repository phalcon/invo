<?php
declare(strict_types=1);

namespace Invo\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
final class DatabaseProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $dbConfig = $di->getShared('config')->get('database')->toArray();
        $di->setShared('db', function () use ($dbConfig) {
            $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $dbConfig['adapter'];
            unset($dbClass['adapter']);

            return new $dbClass($dbClass);
        });
    }
}
