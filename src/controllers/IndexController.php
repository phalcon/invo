<?php
declare(strict_types=1);

namespace Invo\Controllers;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Welcome');
    }

    public function indexAction(): void
    {
        $this->flash->notice(
            'This is a sample application of the Phalcon Framework.
                Please don\'t provide us any personal information. Thanks'
        );
    }
}
