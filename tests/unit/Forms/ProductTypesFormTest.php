<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Forms;

use Codeception\Test\Unit;
use Invo\Forms\ProductTypesForm;
use Phalcon\Forms\Form;

final class ProductTypesFormTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ProductTypesForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }
}
