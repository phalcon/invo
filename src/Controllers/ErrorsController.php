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

    public function show404Action(): void
    {
        $this->response->setStatusCode(404);
    }

    public function show401Action(): void
    {
        $this->response->setStatusCode(401);
    }

    public function show500Action(): void
    {
        $this->response->setStatusCode(500);
    }
}
