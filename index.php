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


