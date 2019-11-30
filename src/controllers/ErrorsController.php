<?php
declare(strict_types=1);

namespace Invo\Controllers;

/**
 * ErrorsController
 *
 * Manage errors
 */
class ErrorsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Oops!');

        parent::initialize();
    }

    public function show404Action()
    {
    }

    public function show401Action()
    {
    }

    public function show500Action()
    {
    }
}
