<?php

namespace Project\Controller;

use Framework\Http\Response;

class BlogController
{
    public function index(): Response
    {
        return new Response("<h1>Blog</h1>");
    }
}


/// La methode d'un controller renvoie toujours une reponse