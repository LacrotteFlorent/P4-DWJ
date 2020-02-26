<?php

require __DIR__ . '/vendor/autoload.php';

use Framework\Http\Request;
use Framework\Http\RedirectionResponse;
use Project\Controller\BlogController;
use Symfony\Component\Dotenv\Dotenv;

/**
 * @source https://symfony.com/doc/current/components/dotenv.html
 * @note Variables d'environnement
 */
$dotenv = new Dotenv();
$dotenv->load(__DIR__. '/public.env');
$dotenv->overload(__DIR__.'/local.env');

$request = Request::createFromGlobals();

$router = new Framework\Router\Router($request);

$router->loadYaml(__DIR__."/config/routing.yml");

$route = $router->getRoute();

$reponse = $route->call($request, $router);

$reponse->send();

