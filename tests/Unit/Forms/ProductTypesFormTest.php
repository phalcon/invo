<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Forms;

use Invo\Forms\ProductTypesForm;
use Phalcon\Di\Di;
use Phalcon\Filter\FilterFactory;
use Phalcon\Forms\Form;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class ProductTypesFormTest extends AbstractUnitTestCase
{
    public static function inputDataProvider(): array
    {
        $key = 'name';

        return [
            [[$key => 'string'], true],
            [[$key => '<h1>Title</h1>'], true],
            [[$key => '1'], true],
            [[], false],
        ];
    }

    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(ProductTypesForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }

    #[DataProvider('inputDataProvider')]
    public function testValidation(array $data, bool $expected): void
    {
        $di           = new Di();
        $di['filter'] = function () {
            return (new FilterFactory())->newInstance();
        };

        $form = new ProductTypesForm();
        $form->setDI($di);

        $this->assertSame($expected, $form->isValid($data));
    }
}
