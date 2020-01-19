<?php
declare(strict_types=1);

namespace Invo\Tests\Acceptance\Controllers;

use AcceptanceTester;

final class ErrorsControllerCest
{
    public function testShow404Action(AcceptanceTester $I): void
    {
        $I->amOnPage('/test');
        $I->see('Page not found');
        $I->seeResponseCodeIs(404);
    }
}
