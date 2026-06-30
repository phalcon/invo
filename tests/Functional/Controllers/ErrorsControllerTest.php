<?php

declare(strict_types=1);

namespace Invo\Tests\Functional\Controllers;

use Invo\Tests\Functional\AbstractFunctionalTestCase;

final class ErrorsControllerTest extends AbstractFunctionalTestCase
{
    public function testShow404Action(): void
    {
        $this->dispatch('/test');

        $this->assertResponseContentContains('Page not found');
        $this->assertResponseCode(404);
    }
}
