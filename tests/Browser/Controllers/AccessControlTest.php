<?php

declare(strict_types=1);

namespace Invo\Tests\Browser\Controllers;

use Invo\Tests\Browser\AbstractBrowserTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class AccessControlTest extends AbstractBrowserTestCase
{
    public static function privateResourceProvider(): array
    {
        return [
            'companies'    => ['/companies'],
            'products'     => ['/products'],
            'producttypes' => ['/producttypes'],
            'invoices'     => ['/invoices'],
        ];
    }

    #[DataProvider('privateResourceProvider')]
    public function testGuestIsDeniedPrivateResource(string $url): void
    {
        $this->visitPage($url);

        $this->assertPageContainsText('Not authorized');
    }
}
