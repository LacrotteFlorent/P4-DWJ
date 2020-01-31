<?php

namespace Framework\Router;

class Route {

    private $path;

    public function __construct($path){
        $this->path = $path;
    }

    //vérifie que la route(chemin) correspond à l'url(REQUEST_URI - ?...)
    public function match($url){


    }

    //vérifie que les parametres correspondent
    public function paramMatch($match){



    }



}