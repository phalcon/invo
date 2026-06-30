<?php

declare(strict_types=1);

namespace Invo\Tests\Browser\Controllers;

use Invo\Tests\Browser\AbstractBrowserTestCase;

final class ProductsControllerTest extends AbstractBrowserTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loginAsDemo();
    }

    public function testCreateRedirectsOnGet(): void
    {
        $this->visitPage('/products/create');

        $this->assertPageContainsText('Products');
    }

    public function testCreateWithInvalidDataShowsErrors(): void
    {
        $this->visitPage('/products/new');
        $this->pressButton('Save product');

        $this->assertPageContainsText('Name is required');
    }

    public function testCreateWithoutTypeShowsError(): void
    {
        $this->visitPage('/products/new');
        $this->fillField('name', 'Orphan');
        $this->fillField('price', '5.00');
        $this->pressButton('Save product');

        $this->assertPageContainsText('product_types_id is required');
    }

    public function testCreateWithValidData(): void
    {
        $this->visitPage('/products/new');
        $this->fillField('name', 'Carrot');
        $this->selectOption('product_types_id', '5');
        $this->fillField('price', '5.00');
        $this->pressButton('Save product');

        $this->assertPageContainsText('Product was created successfully');
    }

    public function testDelete(): void
    {
        $this->visitPage('/products/delete/1');

        $this->assertPageContainsText('Product was deleted');
    }

    public function testDeleteMissingShowsError(): void
    {
        $this->visitPage('/products/delete/999');

        $this->assertPageContainsText('Product was not found');
    }

    public function testEditMissingShowsError(): void
    {
        $this->visitPage('/products/edit/999');

        $this->assertPageContainsText('Product was not found');
    }

    public function testEditShowsForm(): void
    {
        $this->visitPage('/products/edit/1');

        $this->assertPageContainsText('Edit product');
    }

    public function testIndexShowsList(): void
    {
        $this->visitPage('/products');

        $this->assertPageContainsText('Products');
    }

    public function testNewShowsForm(): void
    {
        $this->visitPage('/products/new');

        $this->assertPageContainsText('New product');
    }

    public function testSaveRedirectsOnGet(): void
    {
        $this->visitPage('/products/save');

        $this->assertPageContainsText('Products');
    }

    public function testSaveUpdatesProduct(): void
    {
        $this->visitPage('/products/edit/1');
        $this->fillField('name', 'Artichoke Renamed');
        $this->pressButton('Save product');

        $this->assertPageContainsText('Product was updated successfully');
    }

    public function testSaveWithInvalidData(): void
    {
        $this->visitPage('/products/edit/1');
        $this->fillField('name', '');
        $this->pressButton('Save product');

        $this->assertPageContainsText('Name is required');
    }

    public function testSearchFindsResults(): void
    {
        $this->visitPage('/products');
        $this->pressButton('Search');

        $this->assertPageContainsText('Artichoke');
    }

    public function testSearchWithNoResultsShowsNotice(): void
    {
        $this->visitPage('/products');
        $this->fillField('name', 'Nonexistent Product');
        $this->pressButton('Search');

        $this->assertPageContainsText('The search did not find any products');
    }
}
