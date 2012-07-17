<?php

error_reporting(E_ALL);

try {

    require __DIR__.'/../app/controllers/ControllerBase.php';
    require __DIR__.'/../app/library/Elements.php';

    Phalcon\Session::start();

    $front = Phalcon\Controller\Front::getInstance();

    $config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../app/config/config.ini');
    $front->setConfig($config);

    echo $front->dispatchLoop()->getContent();

} catch (Phalcon\Exception $e) {
    echo "PhalconException: ", $e->getMessage();
}
