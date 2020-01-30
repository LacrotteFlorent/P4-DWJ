<?php

namespace Framework\Router;

class Router {

    private $url;
    private $requete;
    private $routes = [];



    //on vérifie que la route est présente (on teste le param ['action']), s'il est présent on envois la requete vers le controller de la page corrspondante, sinon on renvois vers le controller de la page d'acceuil

    //pour vérifier que la route est présente on apelle la classe route qui vérifie que le chemin existe, s'il existe renvoie vrai sinon renvois faux



    // crée une route pour la méthode $_GET
    public function get($path){
        return $this->add($path, 'GET')
    }

    // crée une route pour la méthode $_POST
    public function post($path){
        return $this->add($path, 'POST')
    }

    // crée une route
    public function add($path, $method){

        $route = new Route($path)
    }

}