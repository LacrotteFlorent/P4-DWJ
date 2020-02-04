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
    public function addRouteGet($path, $controller, $action){
        return $this->addRoute($path, $controller, $action, 'GET');
    }

    // crée une route pour la méthode $_POST
    public function addRoutePost($path, $controller, $action){
        return $this->addRoute($path, $controller, $action, 'POST');
    }

    // crée une route et la stocke dans un tableau
    public function addRoute($path, $controller, $action, $method){

        $route = new Route($path, $controller, $action);
        $this->routes[$method][] = $route;
        dump($this->routes);
        return $route;
    }

    //vérifie si la var "REQUEST_METHOD" existe
    //recherche dans le tableau correspondant à la requete GET OU POST
    //lance la comparaison entres les routes et l'url
    //si il y a match on retourne la route
    public function getRoute(){

        $requestMethod = $this->server["REQUEST_METHOD"];

        if(!isset($requestMethod)){
            throw new RouterException('REQUEST_METHOD does not exist');
        }

        foreach($this->routes[$requestMethod] as $route){
            if($route->match($this->server["REQUEST_URI"])){ 
                return $route;
            }
        }
        
        throw new RouterException('No matching routes');

    }
}