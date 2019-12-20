<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Invo\Controllers\CompaniesController;
use Phalcon\Mvc\Controller;

final class CompaniesControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(CompaniesController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
