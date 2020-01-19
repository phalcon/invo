<?php
declare(strict_types=1);

namespace Invo\Tests\Functional\Models;

use Codeception\Test\Unit;
use Invo\Models\Contact;
use Phalcon\Db\RawValue;
use Phalcon\Di;
use Phalcon\Mvc\Model\Manager;

final class ContactTest extends Unit
{
    public function setUp(): void
    {
        Di::reset();
    }

    public function testBeforeCreate(): void
    {
        $di = new Di();
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
}
