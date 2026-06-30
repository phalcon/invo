<?php

declare(strict_types=1);

namespace Invo\Tests\Browser;

use Invo\Application;
use Invo\Tests\Support\DatabaseSeedTrait;
use Phalcon\Di\Di;
use Phalcon\Talon\PHPUnit\AbstractBrowserTestCase as TalonBrowserTestCase;

abstract class AbstractBrowserTestCase extends TalonBrowserTestCase
{
    use DatabaseSeedTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $this->reseedDatabase();
    }

    /**
     * Build a fresh app per request. invo resolves services through the default DI, so
     * each request resets it and lets the new app become default; session continuity is
     * carried by the process-global $_SESSION (invo authenticates via session, not cookies).
     */
    protected function appFactory(): callable
    {
        return function () {
            Di::reset();

            $bootstrap = new Application(dirname(__DIR__, 2));

            return $this->getProtectedProperty($bootstrap, 'app');
        };
    }

    protected function loginAsDemo(): void
    {
        $this->visitPage('/session');
        $this->fillField('email', 'demo');
        $this->fillField('password', 'phalcon');
        $this->pressButton('//form/*[@type="submit"]');
    }
}
