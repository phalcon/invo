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
    private $headerMenu = [
        'navbar-left' => [
            'index' => [
                'caption' => 'Home',
                'action' => 'index'
            ],
            'invoices' => [
                'caption' => 'Invoices',
                'action' => 'index'
            ],
            'about' => [
                'caption' => 'About',
                'action' => 'index'
            ],
            'contact' => [
                'caption' => 'Contact',
                'action' => 'index'
            ],
        ],
        'navbar-right' => [
            'session' => [
                'caption' => 'Log In/Sign Up',
                'action' => 'index'
            ],
        ]
    ];

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
     * Builds header menu with left and right items
     */
    public function getMenu(): void
    {
        $auth = $this->session->get('auth');
        if ($auth) {
            $this->headerMenu['navbar-right']['session'] = [
                'caption' => 'Log Out',
                'action' => 'end'
            ];
        } else {
            unset($this->headerMenu['navbar-left']['invoices']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';

            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }

                echo $this->tag->linkTo(
                    $controller . '/' . $option['action'],
                    $option['caption']
                );
                echo '</li>';
            }

            echo '</ul>';
            echo '</div>';
        }
    }

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
