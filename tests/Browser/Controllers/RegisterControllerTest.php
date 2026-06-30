<?php

declare(strict_types=1);

namespace Invo\Tests\Browser\Controllers;

use Invo\Tests\Browser\AbstractBrowserTestCase;

final class RegisterControllerTest extends AbstractBrowserTestCase
{
    public function testRegisterShowsForm(): void
    {
        $this->visitPage('/register');

        $this->assertPageContainsText('Create an account');
    }

    public function testRegisterWithInvalidDataShowsErrors(): void
    {
        $this->visitPage('/register');
        $this->pressButton('Sign up');

        $this->assertPageContainsText('Name is required');
    }

    public function testRegisterWithValidData(): void
    {
        $this->visitPage('/register');
        $this->fillField('name', 'Jane Doe');
        $this->fillField('username', 'janedoe');
        $this->fillField('email', 'jane.doe@example.com');
        $this->fillField('password', 'password1');
        $this->fillField('repeatPassword', 'password1');
        $this->pressButton('Sign up');

        $this->assertPageContainsText('Thanks for sign-up, please log-in to start generating invoices');
    }
}
