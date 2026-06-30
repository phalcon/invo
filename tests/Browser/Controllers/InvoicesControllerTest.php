<?php

declare(strict_types=1);

namespace Invo\Tests\Browser\Controllers;

use Invo\Tests\Browser\AbstractBrowserTestCase;

final class InvoicesControllerTest extends AbstractBrowserTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loginAsDemo();
    }

    public function testIndexShowsInvoices(): void
    {
        $this->visitPage('/invoices');

        $this->assertPageContainsText('Your invoices');
    }

    public function testProfileMissingUserRedirects(): void
    {
        $this->pdo()->exec('DELETE FROM users WHERE id = 1');

        $this->visitPage('/invoices/profile');

        $this->assertPageMissingText('Update your profile');
    }

    public function testProfileShowsForm(): void
    {
        $this->visitPage('/invoices/profile');

        $this->assertPageContainsText('Update your profile');
    }

    public function testProfileUpdateWithInvalidData(): void
    {
        $this->visitPage('/invoices/profile');
        $this->fillField('name', '');
        $this->pressButton('Update');

        $this->assertPageContainsText('Name is required');
    }

    public function testProfileUpdateWithValidData(): void
    {
        $this->visitPage('/invoices/profile');
        $this->fillField('name', 'Demo Updated');
        $this->pressButton('Update');

        $this->assertPageContainsText('Your profile information was updated successfully');
    }
}
