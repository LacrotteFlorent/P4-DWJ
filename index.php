<?php

require __DIR__ . '/vendor/autoload.php';

use Framework\Http\Request;
use Framework\Http\RedirectionResponse;
use Project\Controller\BlogController;
 
// header('Location: ./view/host.php');

$request = Request::createFromGlobals();

//dd($request);
dump($request);

$controller = new BlogController();

$response = $controller->index();

//$response = new RedirectionResponse("http://google.fr");

$response->send();


$router = new Framework\Router\Router($request);

$router->get('/contact');

$router->get('/adminConnexion');

$router->get('/billet/:id');

$router->post('/contact/:id');

$router->run();