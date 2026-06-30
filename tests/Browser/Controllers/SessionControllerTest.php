<?php

declare(strict_types=1);

namespace Invo\Tests\Browser\Controllers;

use Invo\Tests\Browser\AbstractBrowserTestCase;

final class SessionControllerTest extends AbstractBrowserTestCase
{
    public function testLoginShowsForm(): void
    {
        $this->visitPage('/session');

        $this->assertPageContainsText('Log in');
    }

    public function testLoginWithValidCredentials(): void
    {
        $this->visitPage('/session');
        $this->fillField('email', 'demo');
        $this->fillField('password', 'phalcon');
        $this->pressButton('Log in');

        $this->assertPageContainsText('Welcome Phalcon Demo');
        $this->assertPageContainsText('Your invoices');
    }

    public function testLoginWithWrongPassword(): void
    {
        $this->visitPage('/session');
        $this->fillField('email', 'demo');
        $this->fillField('password', 'wrong-password');
        $this->pressButton('Log in');

        $this->assertPageContainsText('Wrong email/password');
    }

    public function testLogout(): void
    {
        $this->visitPage('/session/end');

        $this->assertPageContainsText('Goodbye!');
        $this->assertPageContainsText('Invoices, kept in good order.');
    }
}
