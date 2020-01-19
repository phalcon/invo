<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Invo\Controllers\ContactController;
use Phalcon\Mvc\Controller;

final class ContactControllerTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ContactController::class);

        $this->assertInstanceOf(Controller::class, $class);
    }
}
