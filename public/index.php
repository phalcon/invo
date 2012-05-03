<?php

try {
    require __DIR__.'/../app/controllers/ControllerBase.php';
    require __DIR__.'/../app/library/Elements.php';

    Phalcon_Session::start();

    $front = Phalcon_Controller_Front::getInstance();

    $config = new Phalcon_Config_Adapter_Ini(__DIR__.'/../app/config/config.ini');
    $front->setConfig($config);

    echo $front->dispatchLoop()->getContent();
} catch (Phalcon_Exception $e) {
    echo "PhalconException: ", $e->getMessage();
}
