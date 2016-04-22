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
   $view = new \Slim\Views\Twig(__DIR__ . '/../public/source/views',[
       'cache' => false,
       ]);

   $view->addExtension(new \Slim\Views\TwigExtension(

       $container->router,
       $container->request->getUri()

   ));

    return $view;
};

$container['HomeController'] = function(){
    return new Crowdbabble\Controllers\HomeController;
};

require '../src/routers/crowdbabble.router.php';