<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Forms;

use Invo\Forms\ProductsForm;
use Phalcon\Forms\Form;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ProductsFormTest extends AbstractUnitTestCase
{
    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(ProductsForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }
}
