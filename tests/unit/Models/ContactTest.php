<?php
declare(strict_types=1);

namespace Invo\Tests\Unit\Models;

use Codeception\Test\Unit;
use Invo\Models\Contact;
use Phalcon\Mvc\Model;

final class ContactTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(Contact::class);

        $this->assertInstanceOf(Model::class, $class);
    }
}
