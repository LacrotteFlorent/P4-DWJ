<?php

namespace Framework\Router;

class Route {

    private $path;
    private $id;
    private $slug;
    private $pathAlone;

    public function __construct($path){
        $this->path = $path;
        $this->separatePATH();
    }

    


    //vérifie que la route(chemin) correspond à l'url(REQUEST_URI - ?...)
    public function match($url){
        $params = [];
        $this->separateURI($url);

    }

    //vérifie que les parametres correspondent
    public function paramMatch($match){
        


    }

    
    //sépare le chemin d'un id ou slug
    //si le chemin à un '?' on extrait le 
    private function separateURI(){

    }


    private function separatePATH(){

    }


}