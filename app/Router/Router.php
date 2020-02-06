<?php

namespace Framework\Router;

use Symfony\Component\Yaml\Yaml;

class Router {

    private $server;
    private $url;
    private $requete;
    private $routes = [];

    public function __construct($request){
        $this->server = $request->getServer();
        //$this->url = $this->server["REQUEST_URI"];   //Modif PATH_INFO
        $this->url = $request->getPathInfo();
    }

    // charge le fichier YAML dans lequel se trouvent les routes
    public function loadYaml($routesFile){
        $routes = Yaml::parseFile($routesFile);
        foreach($routes as $route){
            dump($route);
            $this->addRoute($route["path"], $route["controller"], $route["action"], $route["method"]);
        }
    }

    // crée une route pour la méthode $_GET
    public function addRouteGet($path, $controller, $action){
        return $this->addRoute($path, $controller, $action, 'GET');
    }

    // crée une route pour la méthode $_POST
    public function addRoutePost($path, $controller, $action){
        return $this->addRoute($path, $controller, $action, 'POST');
    }

    // crée une route et la stocke dans un tableau
    private function addRoute($path, $controller, $action, $method){

        $route = new Route($path, $controller, $action);
        $this->routes[$method][] = $route;
        dump($this->routes);
        return $route;
    }

    //vérifie si la var $_SERVER "REQUEST_METHOD" existe
    //recherche dans le tableau correspondant à la requete GET OU POST
    //lance la comparaison entres les routes et l'url
    //si il y a match on retourne la route
    public function getRoute(){

        $requestMethod = $this->server["REQUEST_METHOD"];

        if(!isset($requestMethod)){
            throw new RouterException('REQUEST_METHOD does not exist');
        }

        foreach($this->routes[$requestMethod] as $route){
            //if($route->match($this->server["REQUEST_URI"])){ 
            //    return $route;
            //}
            if($route->match($this->url)){ 
                return $route;
            }
        }
        
        throw new RouterException('No matching routes');

    }
}