<?php

declare(strict_types=1);

namespace Invo\Tests\Functional\Controllers;

use Invo\Tests\Functional\AbstractFunctionalTestCase;

final class AboutControllerTest extends AbstractFunctionalTestCase
{
    public function testIndexAction(): void
    {
        $this->dispatch('/about');

        $this->assertResponseContentContains('About INVO');
    }
}
