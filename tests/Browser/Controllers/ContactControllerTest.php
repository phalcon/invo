<?php

declare(strict_types=1);

namespace Invo\Tests\Browser\Controllers;

use Invo\Tests\Browser\AbstractBrowserTestCase;

final class ContactControllerTest extends AbstractBrowserTestCase
{
    public function testContactShowsForm(): void
    {
        $this->visitPage('/contact');

        $this->assertPageContainsText('Send message');
    }

    public function testSendRedirectsOnGet(): void
    {
        $this->visitPage('/contact/send');

        $this->assertPageContainsText('Contact');
    }

    public function testSendWithInvalidDataShowsErrors(): void
    {
        $this->visitPage('/contact');
        $this->pressButton('Send message');

        $this->assertPageContainsText('Name is required');
    }

    public function testSendWithValidData(): void
    {
        $this->visitPage('/contact');
        $this->fillField('name', 'Jane Doe');
        $this->fillField('email', 'jane.doe@example.com');
        $this->fillField('comments', 'I would like more information.');
        $this->pressButton('Send message');

        $this->assertPageContainsText('Thanks, we will contact you in the next few hours');
    }
}
