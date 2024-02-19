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
    protected function initialize()
    {
        $this->tag->title()
                  ->prepend('Contractor | ')
        ;
        $this->view->setTemplateAfter('main');
    }
}
