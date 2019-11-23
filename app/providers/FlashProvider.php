<?php
declare(strict_types=1);

namespace Invo\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Flash\Session as FlashSession;

/**
 * Register the flash service with custom CSS classes
 */
final class FlashProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $di->setShared('flash', function () {
            $flash = new FlashSession();
            $flash->setCssClasses([
                'error' => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice' => 'alert alert-info',
                'warning' => 'alert alert-warning'
            ]);

            return $flash;
        });
    }
}
