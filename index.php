<?php

require __DIR__ . '/vendor/autoload.php';

use Framework\Http\Request;
use Framework\Http\RedirectionResponse;
use Project\Controller\BlogController;
 
// header('Location: ./view/host.php');

$request = Request::createFromGlobals();

$controller = new BlogController();

$response = $controller->index();

//$response = new RedirectionResponse("http://google.fr");

$response->send();


$router = new Framework\Router\Router($_GET['url']);

$router->get('/', function(){echo "<h1>Homepage</h1>";});

$router->get('/contact');

$router->get('/adminConnexion');

$router->get('/billet/:slug-:id', "Posts#show");

$router->post('/contact/:id');

$router->run();