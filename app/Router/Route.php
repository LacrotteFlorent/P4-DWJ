<?php

namespace Framework\Router;

class Route {

    private $name;
    private $path;
    private $controller;
    private $action;
    private $matches = [];

    public function __construct($name, $path, $controller, $action){
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->name = $name;
    }

    //non utilisée depuis l'utilisation du PATH_INFO
    //revois une chaine de cractère et retourne cette chaine debarassée de la partie qui se trouve avant la regex
    public function beforeIndexCleaner($strToClean, $regexForCleanBefore){
        $strClean  = preg_split($regexForCleanBefore, $strToClean, 0, PREG_SPLIT_OFFSET_CAPTURE); //selectionne tout ce qui se trouve avant et apres index.php
        $strClean  = $strClean[1]; // garde uniquement la partie de la chaine de caractère apres la regexp (saute le premier element du tableau)
        $strClean  = $strClean[0]; // supprime le tableau pour garder uniquement la chaine de caractère restante
        return $strClean;
    }

    //MODIF PATH_INFO
    ////teste si la route et bonne et récupères les paramètres de la requète
    //public function match($requestUri){
    //    $path = preg_replace("/:(\w+)/", "([\d]+)", $this->beforeIndexCleaner($this->path, "/(.index\.php)+/")); // remplace les paramètres par des regexp   preg_replace("recherche", "caractère de remplacement", "sujet à modifier")  [\d] = un chiffre entre 0-9
    //    $path = str_replace("/","\/", $path); // remplace les / par des / échappés
    //    dump($path);
    //    dump($requestUri);
    //    if(!preg_match("/^$path$/i", $this->beforeIndexCleaner($requestUri, "/(.index\.php)+/"), $matches)){  //si notre requete actuelle ne correspond pas a la regexp on retourne false
    //        echo"FALSE";
    //        return false;
    //    }
    //    //sinon on stocke nos argument dans un tableau
    //    array_shift($matches); // on saute le premier élément du tableau
    //    $this->matches = $matches; // on sauvegarde les paramètres dans l'instance
    //    dump($matches);
    //    dump($this->matches);
    //    return true;
    //}

    //teste si la route et bonne et récupères les paramètres de la requète
    public function match($requestUri){
        $path = preg_replace("/:(\w+)/", "([\d]+)", $this->path); // remplace les paramètres par des regexp   preg_replace("recherche", "caractère de remplacement", "sujet à modifier")  [\d] = un chiffre entre 0-9
        $path = str_replace("/","\/", $path); // remplace les / par des / échappés
        dump($path);
        dump($requestUri);
        if(!preg_match("/^$path$/i", $requestUri, $matches)){  //si notre requete actuelle ne correspond pas a la regexp on retourne false
            echo"FALSE";
            return false;
        }
        //sinon on stocke nos argument dans un tableau
        array_shift($matches); // on saute le premier élément du tableau
        $this->matches = $matches; // on sauvegarde les paramètres dans l'instance
        dump($matches);
        dump($this->matches);
        return true;
    }

    private function paramMatch(){
        
    }

    //ATTENTION SI ON A DES PARAMS après un ? la route n'est plus OK

    // NON NECESSAIRE DEPUIS L'UTILISATION DU PATH_INFO
    // recupères les paramètres après la requete et les retournes
    public function paramAfterRequest(){

    }


    //on instancie le controller dynamiquement et on apelle la méthode correspondante
    public function call(){
        $controller = "Project\\Controller\\" . $this->controller . "Controller";
        dump($controller);
        $controller = new $controller();
        return call_user_func_array([$controller, $this->action], $this->matches);
    }

    public function getPath(){
        return $this->path;
    }
}