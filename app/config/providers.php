<?php

return [
    'config' => [
        'className' => \Invo\Providers\ConfigProvider::class,
        'shared' => true,
    ],
    'db' => [
        'className' => \Invo\Providers\DatabaseProvider::class,
        'shared' => true,
    ],
    'dispatcher' => [
        'className' => \Invo\Providers\DispatcherProvider::class,
        'shared' => true,
    ],
    'elements' => [
        'className' => \Invo\Providers\ElementsProvider::class,
        'shared' => true,
    ],
    'flash' => [
        'className' => \Invo\Providers\FlashProvider::class,
        'shared' => true,
    ],
    'session' => [
        'className' => \Invo\Providers\SessionProvider::class,
        'shared' => true,
    ],
    'url' => [
        'className' => \Invo\Providers\UrlProvider::class,
        'shared' => true,
    ],
    'view' => [
        'className' => \Invo\Providers\ViewProvider::class,
        'shared' => true,
    ],
    'volt' => [
        'className' => \Invo\Providers\VoltProvider::class,
        'shared' => true,
    ],
];
