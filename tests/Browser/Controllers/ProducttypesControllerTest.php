<?php

declare(strict_types=1);

namespace Invo\Tests\Browser\Controllers;

use Invo\Tests\Browser\AbstractBrowserTestCase;

final class ProducttypesControllerTest extends AbstractBrowserTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loginAsDemo();
    }

    public function testCreateRedirectsOnGet(): void
    {
        $this->visitPage('/producttypes/create');

        $this->assertPageContainsText('Product types');
    }

    public function testCreateWithInvalidDataShowsErrors(): void
    {
        $this->visitPage('/producttypes/new');
        $this->pressButton('Save type');

        $this->assertPageContainsText('Name is required');
    }

    public function testCreateWithValidData(): void
    {
        $this->visitPage('/producttypes/new');
        $this->fillField('name', 'Dairy');
        $this->pressButton('Save type');

        $this->assertPageContainsText('Product type was created successfully');
    }

    public function testDelete(): void
    {
        $this->visitPage('/producttypes/delete/6');

        $this->assertPageContainsText('Product types was deleted');
    }

    public function testDeleteInUseShowsError(): void
    {
        $this->visitPage('/producttypes/delete/5');

        $this->assertPageContainsText('Product Type cannot be deleted');
    }

    public function testDeleteMissingShowsError(): void
    {
        $this->visitPage('/producttypes/delete/999');

        $this->assertPageContainsText('Product types was not found');
    }

    public function testEditMissingShowsError(): void
    {
        $this->visitPage('/producttypes/edit/999');

        $this->assertPageContainsText('Product type to edit was not found');
    }

    public function testEditShowsForm(): void
    {
        $this->visitPage('/producttypes/edit/5');

        $this->assertPageContainsText('Edit product type');
    }

    public function testIndexShowsList(): void
    {
        $this->visitPage('/producttypes');

        $this->assertPageContainsText('Product types');
    }

    public function testNewShowsForm(): void
    {
        $this->visitPage('/producttypes/new');

        $this->assertPageContainsText('New product type');
    }

    public function testSaveRedirectsOnGet(): void
    {
        $this->visitPage('/producttypes/save');

        $this->assertPageContainsText('Product types');
    }

    public function testSaveUpdatesProductType(): void
    {
        $this->visitPage('/producttypes/edit/5');
        $this->fillField('name', 'Veggies');
        $this->pressButton('Save type');

        $this->assertPageContainsText('Product Type was updated successfully');
    }

    public function testSaveWithInvalidData(): void
    {
        $this->visitPage('/producttypes/edit/5');
        $this->fillField('name', '');
        $this->pressButton('Save type');

        $this->assertPageContainsText('Name is required');
    }

    public function testSearchFindsResults(): void
    {
        $this->visitPage('/producttypes');
        $this->pressButton('Search');

        $this->assertPageContainsText('Vegetables');
    }

    public function testSearchWithNoResultsShowsNotice(): void
    {
        $this->visitPage('/producttypes');
        $this->fillField('name', 'Nonexistent Type');
        $this->pressButton('Search');

        $this->assertPageContainsText('The search did not find any product types');
    }
}
