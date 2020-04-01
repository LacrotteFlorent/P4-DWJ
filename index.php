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
//FlashBag::getInstance();
//dump($_SESSION);

//$_POST['firstName'] = 'testPrénom';
//$_POST['lastName'] = 'testNom';
//$_POST['mail'] = 'testMail.com';
//$_POST['acceptRGPD'] = 'on';
//dump($_SESSION);


//(FlashBag::getInstance())->add("red","ceci est un message long 1");
//(FlashBag::getInstance())->add("green","ceci est un message long 2");
//(FlashBag::getInstance())->add("blue","ceci est un message lonnnnnnnnnnnnnnnnnnnnnnnng longggggggg 3");
//(FlashBag::getInstance())->add("orange","ceci est un message4");
//(FlashBag::getInstance())->add("yellow","ceci est un message5");
//dump(count(FlashBag::getInstance()));
//foreach(FlashBag::getInstance() as $mess){
//    dump($mess);
//}
//dump(count(FlashBag::getInstance()));

$request = Request::createFromGlobals();

$router = new Framework\Router\Router($request);

$router->loadYaml(__DIR__."/config/routing.yml");

$route = $router->getRoute();

$reponse = $route->call($request, $router);

$reponse->send();

