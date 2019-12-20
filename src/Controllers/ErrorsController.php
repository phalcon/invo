<?php
declare(strict_types=1);

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
