<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Forms;

use Codeception\Test\Unit;
use Invo\Forms\ProductsForm;
use Phalcon\Forms\Form;

final class ProductsFormTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ProductsForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }
}
