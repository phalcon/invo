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

class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->title()
                  ->set('Welcome')
        ;
    }

    public function indexAction(): void
    {
        $this->flash->notice(
            'Contractor app built with the Phalcon Framework.'
        );
    }
}
