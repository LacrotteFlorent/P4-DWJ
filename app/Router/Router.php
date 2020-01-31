<?php

namespace Framework\Router;

class Router {

    private $server;
    private $url;
    private $requete;
    private $routes = [];

    public function __construct($request){
        $this->server = $request->getServer();
        $this->url = $this->server["REQUEST_URI"];
    }

    //on vérifie que la route est présente (on teste le param ['action']), s'il est présent on envois la requete vers le controller de la page corrspondante, sinon on renvois vers le controller de la page d'acceuil

    //pour vérifier que la route est présente on apelle la classe route qui vérifie que le chemin existe, s'il existe renvoie vrai sinon renvois faux



    // crée une route pour la méthode $_GET
    public function get($path){
        return $this->add($path, 'GET');
    }

    // crée une route pour la méthode $_POST
    public function post($path){
        return $this->add($path, 'POST');
    }

    // crée une route et la stocke dans un tableau
    public function add($path, $method){

        $route = new Route($path);
        $this->routes[$method][] = $route;
        dump($this->routes);
        return $route;
    }

    //vérifie si la var "REQUEST_METHOD" existe
    //recherche dans le tableau correspondant à la requete GET OU POST
    //lance la comparaison entres les routes et l'url
    //si il y a match apelle le controller correspondant
    public function run(){

        $requestMethod = $this->server["REQUEST_METHOD"];

        if(!isset($requestMethod)){
            throw new RouterException('REQUEST_METHOD does not exist');
        }

        foreach($this->routes[$requestMethod] as $route){
            if($route->match($this->server["REQUEST_URI"])){
                // appelle le controller
                return print("test");
            }
        }
        
        //throw new RouterException('No matching routes');

    }
}