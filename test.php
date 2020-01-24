<?php

require_once './vendor/autoload.php';
require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;

class Person {
    private $firstname;
    private $lastname;
    private $age;
    
    public function __construct ($firstname, $lastname, $age) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
    }

    public function getName() {
        return $this->firstname .' ' . $this->lastname;
    }
}

$Florent = new Person('Florent', 'Lacrotte', 28);

var_dump($Florent);

dump($Florent);

echo($Florent->getName());

$dotenv = new Dotenv();
$dotenv->load('../varEnvP4.env');

$test = $_ENV['TEST'];
dump($test);

$deuxiemeTest = $_ENV['TEST2'];
dump($deuxiemeTest);


// test Twig ! Template engine

$loader = new \Twig\Loader\ArrayLoader([
    'index' => 'Hello {{ name }}!',
]);
$twig = new \Twig\Environment($loader);

echo $twig->render('index', ['name' => 'Fabien']);

$variableContentTest = "<h1>Ici un bon gros title</h1>";