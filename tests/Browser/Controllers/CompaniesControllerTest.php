<?php

declare(strict_types=1);

namespace Invo\Tests\Browser\Controllers;

use Invo\Tests\Browser\AbstractBrowserTestCase;

final class CompaniesControllerTest extends AbstractBrowserTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loginAsDemo();
    }

    public function testCreateRedirectsOnGet(): void
    {
        $this->visitPage('/companies/create');

        $this->assertPageContainsText('Companies');
    }

    public function testCreateWithInvalidDataShowsErrors(): void
    {
        $this->visitPage('/companies/new');
        $this->pressButton('Save company');

        $this->assertPageContainsText('Name is required');
    }

    public function testCreateWithValidData(): void
    {
        $this->visitPage('/companies/new');
        $this->fillField('name', 'Globex');
        $this->fillField('telephone', '555-0100');
        $this->fillField('address', '1 Main St');
        $this->fillField('city', 'Springfield');
        $this->pressButton('Save company');

        $this->assertPageContainsText('Company was created successfully');
    }

    public function testDelete(): void
    {
        $this->visitPage('/companies/delete/1');

        $this->assertPageContainsText('Company was deleted');
    }

    public function testDeleteMissingShowsError(): void
    {
        $this->visitPage('/companies/delete/999');

        $this->assertPageContainsText('Company was not found');
    }

    public function testEditMissingShowsError(): void
    {
        $this->visitPage('/companies/edit/999');

        $this->assertPageContainsText('Company was not found');
    }

    public function testEditShowsForm(): void
    {
        $this->visitPage('/companies/edit/1');

        $this->assertPageContainsText('Edit company');
    }

    public function testIndexShowsList(): void
    {
        $this->visitPage('/companies');

        $this->assertPageContainsText('Companies');
    }

    public function testNewShowsForm(): void
    {
        $this->visitPage('/companies/new');

        $this->assertPageContainsText('New company');
    }

    public function testSaveMissingShowsError(): void
    {
        $this->visitPage('/companies/edit/1');
        $this->fillField('id', '999');
        $this->pressButton('Save company');

        $this->assertPageContainsText('Company does not exist');
    }

    public function testSaveRedirectsOnGet(): void
    {
        $this->visitPage('/companies/save');

        $this->assertPageContainsText('Companies');
    }

    public function testSaveUpdatesCompany(): void
    {
        $this->visitPage('/companies/edit/1');
        $this->fillField('name', 'Acme Renamed');
        $this->pressButton('Save company');

        $this->assertPageContainsText('Company was updated successfully');
    }

    public function testSaveWithInvalidData(): void
    {
        $this->visitPage('/companies/edit/1');
        $this->fillField('name', '');
        $this->pressButton('Save company');

        $this->assertPageContainsText('Name is required');
    }

    public function testSearchFindsResults(): void
    {
        $this->visitPage('/companies');
        $this->pressButton('Search');

        $this->assertPageContainsText('Acme');
    }

    public function testSearchWithNoResultsShowsNotice(): void
    {
        $this->visitPage('/companies');
        $this->fillField('name', 'Nonexistent Company');
        $this->pressButton('Search');

        $this->assertPageContainsText('The search did not find any companies');
    }
}
