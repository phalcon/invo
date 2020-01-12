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

namespace Invo\Plugins;

use Phalcon\Di\Injectable;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class ElementsPlugin extends Injectable
{
    /**
     * @var array
     */
    private $tabs = [
        'Invoices' => [
            'controller' => 'invoices',
            'action' => 'index',
            'any' => false
        ],
        'Companies' => [
            'controller' => 'companies',
            'action' => 'index',
            'any' => true
        ],
        'Products' => [
            'controller' => 'products',
            'action' => 'index',
            'any' => true
        ],
        'Product Types' => [
            'controller' => 'producttypes',
            'action' => 'index',
            'any' => true
        ],
        'Your Profile' => [
            'controller' => 'invoices',
            'action' => 'profile',
            'any' => false
        ]
    ];

    /**
     * Returns menu tabs
     */
    public function getTabs(): void
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();

        echo '<ul class="nav nav-tabs">';

        foreach ($this->tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }

            echo $this->tag->linkTo(
                $option['controller'] . '/' . $option['action'],
                $caption
            );
            echo '</li>';
        }

        echo '</ul>';
    }
}
