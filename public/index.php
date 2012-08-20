<?php


error_reporting(E_ALL);

try {

    require __DIR__.'/../app/controllers/ControllerBase.php';
    require __DIR__.'/../app/library/Elements.php';

    Phalcon\Session::start();

    //Read the configuration
    $config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../app/config/config.ini');

	$loader = new \Phalcon\Loader();

	//Register the directories in the configuration as part of the autoloader
	$loader->registerDirs(
		array(
			__DIR__.$config->phalcon->controllersDir, 
			__DIR__.$config->phalcon->modelsDir
		)
	)->register();

	$di = new \Phalcon\DI();

	//Registering a router
	$di->set('router', function(){
		return new Phalcon\Mvc\Router();
	});	

	//Registering a dispatcher
	$di->set('dispatcher', function(){
		return new Phalcon\Mvc\Dispatcher();
	});		

	//Registering a Http\Response 
	$di->set('response', 'Phalcon\Http\Response');

	//Registering a Http\Request
	$di->set('request', 'Phalcon\Http\Request');

	//Register the url service with a default baseUri
	$di->set('url', function() use ($config){
		$url = new \Phalcon\Mvc\Url();
		$url->setBaseUri($config->phalcon->baseUri);
		return $url;
	});

	//Registering the view component
	$di->set('view', function() use ($config) {
		$view = new \Phalcon\Mvc\View();
		$view->setViewsDir(__DIR__.$config->phalcon->viewsDir);
		return $view;
	});
		
	//This starts a new connection based on the parameters in the configuration file
	$di->set('db', function() use ($config) {
		return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
			"host" => $config->database->host,
			"username" => $config->database->username,
			"password" => $config->database->password,
			"dbname" => $config->database->name
		));
	});

	//If the configuration specify the use of metadata adapter use it or use memory otherwise
	$di->set('modelsMetadata', function() use ($config) {		
		if(isset($config->models->metadata)){
			$metaDataConfig = $config->models->metadata;
			$metadataAdapter = 'Phalcon\Mvc\Model\Metadata\\'.$metaDataConfig->adapter;
			return new $metadataAdapter();
		} else {
			return new Phalcon\Mvc\Model\Metadata\Memory();
		}
	});

	//Registering the Models Manager
	$di->set('modelsManager', function(){
		return new Phalcon\Mvc\Model\Manager();
	});

	$application = new \Phalcon\Mvc\Application();
	$application->setDI($di);
	echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
	echo $e->getMessage();
}
