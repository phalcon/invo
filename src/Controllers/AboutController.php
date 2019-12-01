<?php
declare(strict_types=1);

namespace Invo\Controllers;

class AboutController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('About us');
    }

    public function indexAction(): void
    {
    }
}
