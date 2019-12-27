<?php
declare(strict_types=1);

namespace Invo\Tests\Acceptance\Controllers;

use AcceptanceTester;

final class AboutControllerCest
{
    public function testIndexAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/about');
        $I->see('About INVO');
    }
}
