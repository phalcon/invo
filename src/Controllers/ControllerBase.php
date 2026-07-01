<?php

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Invo\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function flashErrorsAndForward(
        iterable $messages,
        string $controller,
        string $action,
        array $params = []
    ): void {
        foreach ($messages as $message) {
            $this->flash->error((string) $message);
        }

        $this->forward($controller, $action, $params);
    }

    protected function forward(string $controller, string $action, array $params = []): void
    {
        $this->dispatcher->forward([
            'controller' => $controller,
            'action'     => $action,
            'params'     => $params,
        ]);
    }

    protected function initialize()
    {
        $this->tag->title()
                  ->prepend('INVO | ')
        ;
        $this->view->setTemplateAfter('main');
    }

    protected function notFound(string $message, string $controller, string $action, array $params = []): void
    {
        $this->flash->error($message);
        $this->forward($controller, $action, $params);
    }
}
