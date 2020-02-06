<?php

require __DIR__ . '/vendor/autoload.php';

use Framework\Http\Request;
use Framework\Http\RedirectionResponse;
use Project\Controller\BlogController;

 
// header('Location: ./view/host.php');

$request = Request::createFromGlobals();

dump($request);

//$controller = new BlogController();

//$response = $controller->index();

//$response = new RedirectionResponse("http://google.fr");

//$response->send();



$router = new Framework\Router\Router($request);

$router->loadYaml(__DIR__."/config/routing.yml");

//$router->addRouteGet('route1','/BLOGNEW_P4/index.php/contact', 'Blog', "index");
//
//$router->addRouteGet('route2','/BLOGNEW_P4/index.php/adminConnexion','Blog', "index");
//
//$router->addRouteGet('route3','/BLOGNEW_P4/index.php/billet/:id','Blog', "index");
//
//$router->addRoutePost('route4','/BLOGNEW_P4/index.php/contactPost/:id','Blog', "index");

$route = $router->getRoute();

$reponse = $route->call();

dump($router->getRouteByName("contacte"));


$reponse->send();

