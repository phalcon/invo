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

namespace Invo\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Url;

/**
 * The URL component is used to generate all kind of urls in the application
 */
class UrlProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $baseUri = $di->getShared('config')->application->baseUri;
        $di->setShared('url', function () use ($baseUri) {
            $url = new Url();
            $url->setBaseUri($baseUri);

            return $url;
        });
    }
}
