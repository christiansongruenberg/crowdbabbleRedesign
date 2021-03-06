<?php
//bootstrap file sets up the app with configuration.
//this code is not in the index.php because it shoudl stay out of the public folder


//start session
session_start();

//autoload all vendor namespaces with composer autoloader
require __DIR__ . '/../vendor/autoload.php';

//instatntiate
$app = new \Slim\App([
   'settings' => [
       'displayErrorDetails' => true,
   ]
]);

$container = $app->getContainer();

$container['view'] = function($container){
   $view = new \Slim\Views\Twig(__DIR__ . '/../public/resources/views',[
       'cache' => false,
       ]);

   $view->addExtension(new \Slim\Views\TwigExtension(

       $container->router,
       $container->request->getUri()

   ));

    return $view;
};

$container['logger'] = function($container){
    $logger = new\Monolog\Logger('Crowdbabble_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/" . date("Y-d-m") . "-CBapp.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

//instatiate the controllers on the container so it can be used in the routes
$container['HomeController'] = function($container){
    return new \Crowdbabble\Controllers\HomeController($container);
};

require '../src/routers/crowdbabble.router.php';