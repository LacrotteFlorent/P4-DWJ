<?php

require __DIR__ . '/vendor/autoload.php';

use Framework\Http\Request;
use Framework\Http\RedirectionResponse;
use Project\Controller\BlogController;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\ErrorHandler\DebugClassLoader;

/**
 * @source https://symfony.com/doc/current/components/dotenv.html
 * @note Environment Variables
 */
$dotenv = new Dotenv();
$dotenv->load(__DIR__. '/public.env');
$dotenv->overload(__DIR__.'/local.env');

/**
 * @source https://symfony.com/doc/current/components/error_handler.html
 * @note Error Handler
 * @note Attention à la sécuritée 
 */
if ($_SERVER['DEV']) {
    Debug::enable();
    ErrorHandler::register();
    DebugClassLoader::enable();
}

$request = Request::createFromGlobals();

$router = new Framework\Router\Router($request);

$router->loadYaml(__DIR__."/config/routing.yml");

$route = $router->getRoute();

$reponse = $route->call($request, $router);

$reponse->send();

