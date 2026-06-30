<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Forms;

use Invo\Forms\CompaniesForm;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class CompaniesFormTest extends AbstractUnitTestCase
{
    public function testIdElementType(): void
    {
        $createForm = new CompaniesForm();
        $editForm   = new CompaniesForm(null, ['edit' => true]);

        $this->assertInstanceOf(Text::class, $createForm->getElements()['id']);
        $this->assertInstanceOf(Hidden::class, $editForm->getElements()['id']);
    }

    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(CompaniesForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }
}
