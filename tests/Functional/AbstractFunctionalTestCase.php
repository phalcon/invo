<?php

declare(strict_types=1);

namespace Invo\Tests\Functional;

use Invo\Application;
use Phalcon\Di\Di;
use Phalcon\Talon\PHPUnit\AbstractFunctionalTestCase as TalonFunctionalTestCase;

abstract class AbstractFunctionalTestCase extends TalonFunctionalTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $_SESSION = [];
    }

    protected function appFactory(): callable
    {
        return function () {
            Di::reset();

            $bootstrap = new Application(dirname(__DIR__, 2));

            return $this->getProtectedProperty($bootstrap, 'app');
        };
    }
}
