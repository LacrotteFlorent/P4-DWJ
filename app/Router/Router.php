<?php

namespace Framework\Router;

use Framework\Http\Request;
use Symfony\Component\Yaml\Yaml;

class Router {

    /**
     * @var string
     */
    private $requestMethod;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Routes[]
     */
    private $routes = [];

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->url = $request->getPathInfo();
        $this->requestMethod = $request->getRequestMethod();
    }

    /**
     * @param string $routesFile
     */
    public function loadYaml(string $routesFile)
    {
        $routes = Yaml::parseFile($routesFile);
        foreach($routes as $name => $route){
            $this->addRoute($name, $route["path"], $route["controller"], $route["action"]);
        }
    }

    /**
     * @param string $name
     * @param string $path
     * @param string $controller
     * @param string $action
     */
    private function addRoute($name, $path, $controller, $action)
    {
        $this->routes[$name] = new Route($name, $path, $controller, $action);
    }

    /**
     * @return Route
     * @throws RouterException
     */
    public function getRoute(): Route
    {
        if(!isset($this->requestMethod))
        {
            throw new RouterException('REQUEST_METHOD does not exist');
        }

        foreach($this->routes as $route){
            if($route->match($this->url)){ 
                return $route;
            }
        }
        
        throw new RouterException('No matching routes');
    }

    /**
     * @param string $name
     * @return Route
     * @throws RouterException
     */
    public function getRouteByName(string $name): Route
    {
        if(isset($this->routes[$name])){
            return $this->routes[$name];
        }

        throw new RouterException('This way\'s doesn\'t exist');
    }

}
