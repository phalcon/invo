<?php

declare(strict_types=1);

namespace Invo\Tests\Functional\Controllers;

use Invo\Tests\Functional\AbstractFunctionalTestCase;

final class ErrorsControllerTest extends AbstractFunctionalTestCase
{
    public function testShow401Action(): void
    {
        $this->dispatch('/errors/show401');

        $this->assertResponseContentContains('Not authorized');
        $this->assertResponseCode(401);
    }

    public function testShow404Action(): void
    {
        $this->dispatch('/test');

        $this->assertResponseContentContains('Page not found');
        $this->assertResponseCode(404);
    }

    public function testShow500Action(): void
    {
        $this->dispatch('/errors/show500');

        $this->assertResponseContentContains('Something went wrong');
        $this->assertResponseCode(500);
    }
}
