<?php

namespace Framework\Router;

use Symfony\Component\Yaml\Yaml;

class Router {

    //private $server;
    private $requestMethod;
    private $url;
    //private $requete;
    private $routes = [];
    private $routesByName = [];

    public function __construct($request){
        //$this->server = $request->getServer();
        //$this->url = $this->server["REQUEST_URI"];   //Modif PATH_INFO
        $this->url = $request->getPathInfo();
        $this->requestMethod = $request->getRequestMethod();
    }

    // charge le fichier YAML dans lequel se trouvent les routes
    public function loadYaml($routesFile){
        $routes = Yaml::parseFile($routesFile);
        foreach($routes as $name => $route){
            dump($route);
            $this->addRoute($name, $route["path"], $route["controller"], $route["action"], $route["method"]);
        }
    }

    // crée une route pour la méthode $_GET
    public function addRouteGet($name, $path, $controller, $action){
        return $this->addRoute($name, $path, $controller, $action, 'GET');
    }

    // crée une route pour la méthode $_POST
    public function addRoutePost($name, $path, $controller, $action){
        return $this->addRoute($name, $path, $controller, $action, 'POST');
    }

    // crée une route et la stocke dans un tableau
    private function addRoute($name, $path, $controller, $action, $method){

        $route = new Route($name, $path, $controller, $action);
        $this->routes[$method][] = $route;
        $this->routesByName[$name][] = $route;
        dump($this->routes);
        dump($this->routesByName);
    }

    //vérifie si la var $_SERVER "REQUEST_METHOD" existe
    //recherche dans le tableau correspondant à la requete GET OU POST
    //lance la comparaison entres les routes et l'url
    //si il y a match on retourne la route
    public function getRoute(){

        if(!isset($this->requestMethod)){
            throw new RouterException('REQUEST_METHOD does not exist');
        }

        foreach($this->routes[$this->requestMethod] as $route){
            //if($route->match($this->server["REQUEST_URI"])){ 
            //    return $route;
            //}
            if($route->match($this->url)){ 
                return $route;
            }
        }
        
        throw new RouterException('No matching routes');

    }

    //retourne la route si elle existe, sinon affiche une exception
    public function getRouteByName($name){
        if(isset($this->routesByName[$name])){
            return $this->routesByName[$name];
        }

        throw new RouterException('This way\'s doesn\'t exist');
    }

}
