<?php


require "Forme.php";
require "Carre.php";
require "Cercle.php";
require "Triangle.php";
require "Person.php";
require "Policier.php";


echo (new Carre)->aire() . PHP_EOL;
echo (new Triangle)->aire() . PHP_EOL;

echo (new Policier("Honore", "Hounwanou", 54, "Sergent"))->getFullName() . PHP_EOL;


echo (new Cercle)->aire() . PHP_EOL;



class Boom
{
    public function test(Forme $forme)
    {
        echo $forme->aire();
    }
}

(new Boom)->test(new Carre);