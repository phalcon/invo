<?php

declare(strict_types=1);

namespace Invo\Tests\Unit;

use Invo\Application;
use Invo\Exception;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ApplicationTest extends AbstractUnitTestCase
{
    public function testGetRootPath(): void
    {
        $rootPath    = dirname(__DIR__, 2);
        $application = new Application($rootPath);

        $this->assertSame($rootPath, $application->getRootPath());
    }

    public function testRunReturnsRenderedContent(): void
    {
        $_SERVER['REQUEST_URI'] = '/';

        $application = new Application(dirname(__DIR__, 2));

        $this->assertStringContainsString('Invoices, kept in good order.', $application->run());
    }

    public function testThrowsWhenProvidersFileMissing(): void
    {
        $this->expectException(Exception::class);

        new Application('/nonexistent-invo-root');
    }
}
