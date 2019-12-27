<?php
declare(strict_types=1);

namespace Invo\Tests\Acceptance\Controllers;

use AcceptanceTester;

final class IndexControllerCest
{
    public function testIndex(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->see('Welcome to INVO');
    }
}
