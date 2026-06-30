<?php

declare(strict_types=1);

namespace Invo\Tests\Functional\Controllers;

use Invo\Tests\Functional\AbstractFunctionalTestCase;

final class IndexControllerTest extends AbstractFunctionalTestCase
{
    public function testIndex(): void
    {
        $this->dispatch('/');

        $this->assertResponseContentContains('Invoices, kept in good order.');
    }
}
