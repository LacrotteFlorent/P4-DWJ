<?php

namespace Framework\Router;

use Framework\Http\Request;
use Framework\Http\ResponseInterface;

class Route {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $matches = [];

    /**
     * Route constructor.
     * @param string $name
     * @param string $path
     * @param string $controller
     * @param string $action
     */
    public function __construct($name, $path, $controller, $action)
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->name = $name;
    }

    /**
     * @param string $requestUri
     * @return bool
     */
    public function match(string $requestUri): bool
    {
        $path = preg_replace("/:(\w+)/", "([\d]+)", $this->path); 
        $path = str_replace("/","\/", $path);
        if(!preg_match("/^$path$/i", $requestUri, $matches)){
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    /**
     * @param Request $request
     * @param Router $router
     * @return ResponseInterface
     */
    public function call(Request $request, Router $router): ResponseInterface
    {
        $controller = "Project\\Controller\\" . $this->controller . "Controller";
        $controller = new $controller($request, $router);
        if($this->matches){
            return call_user_func_array([$controller, $this->action], $this->matches);
        }
        return call_user_func_array([$controller, $this->action], array('0'));
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}