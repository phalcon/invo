<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Forms;

use Codeception\Test\Unit;
use Invo\Forms\CompaniesForm;
use Phalcon\Forms\Form;

final class CompaniesFormTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(CompaniesForm::class);

        $this->assertInstanceOf(Form::class, $class);
    }
}
