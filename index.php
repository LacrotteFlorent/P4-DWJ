<?php

require __DIR__ . '/vendor/autoload.php';

use Framework\Http\Request;
use Framework\Http\RedirectionResponse;
use Project\Controller\BlogController;

 
$request = Request::createFromGlobals();

$router = new Framework\Router\Router($request);

$router->loadYaml(__DIR__."/config/routing.yml");

$route = $router->getRoute();

$reponse = $route->call($request, $router);

$reponse->send();

