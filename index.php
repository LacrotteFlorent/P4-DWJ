<?php

require __DIR__ . '/vendor/autoload.php';

use Framework\Http\Request;
use Framework\Http\RedirectionResponse;
use Project\Controller\BlogController;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\ErrorHandler\DebugClassLoader;
use Framework\FlashBag;

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
 */
if ($_ENV['DEV'] === 'On') {
    Debug::enable();
    ErrorHandler::register();
    DebugClassLoader::enable();
}

session_start();

//$_POST['submit'] = 2;

$request = Request::createFromGlobals();

$router = new Framework\Router\Router($request);

$router->loadYaml(__DIR__."/config/routing.yml");

$route = $router->getRoute();

$reponse = $route->call($request, $router);

$reponse->send();