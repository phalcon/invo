<?php

declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Invo\Models\Contact;
use Phalcon\Db\RawValue;
use Phalcon\Di\Di;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Talon\PHPUnit\AbstractUnitTestCase;

final class ContactTest extends AbstractUnitTestCase
{
    public function testBeforeCreate(): void
    {
        $di                  = new Di();
        $di['modelsManager'] = function () {
            return new Manager();
        };

        $class = new Contact();
        $class->setDI($di);
        $class->beforeCreate();

        /** @var RawValue $raw */
        $raw = $class->created_at;

        $this->assertSame('now()', $raw->__toString());
    }

    public function testImplementation(): void
    {
        $class = $this->mockWithoutConstructor(Contact::class);

        $this->assertInstanceOf(Model::class, $class);
    }
}
