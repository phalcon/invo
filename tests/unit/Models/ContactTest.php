<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Codeception\Test\Unit;
use Invo\Models\Contact;
use Phalcon\Db\RawValue;
use Phalcon\Mvc\Model;

final class ContactTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(Contact::class);

        $this->assertInstanceOf(Model::class, $class);
    }

    public function testBeforeCreate(): void
    {
        $class = new Contact();
        $class->beforeCreate();

        /** @var RawValue $raw */
        $raw = $class->created_at;

        $this->assertSame('now()', $raw->__toString());
    }
}
