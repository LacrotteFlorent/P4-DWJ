<?php

namespace Project\Controller;

use Framework\Http\Response;
use Framework\Http\RedirectionResponse;
use Framework\Http\RedirectionResponseDebug;

class BlogController
{
    private $path;


    public function __construct($path){
        $this->path = $path;
    }


    // retourne une réponse basique
    public function index(): Response
    {
        return new Response("<h1>Blog</h1>");
    }

    // redirige vers la page reçue en argument
    public function redirection(): RedirectionResponse
    {
        return new RedirectionResponse($this->path);
    }
}


/// La methode d'un controller renvoie toujours une reponse