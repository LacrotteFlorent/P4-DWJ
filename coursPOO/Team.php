<?php


class Team
{
    private $name;
    private $nbFan = 0;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getNbFan() {
        return $this->nbFan;
    }

}

class League
{

}


$barcelona = new Team("Barcelona");
$realMadrid = new Team("Real Madrid");


echo  $barcelona->getName() . ' a ' . $barcelona->getNbFan() . ' fans ' . PHP_EOL;
echo  $realMadrid->getName() . ' a ' . $realMadrid->getNbFan() . ' fans ' . PHP_EOL;