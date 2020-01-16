<?php

require './vendor/autoload.php';

$honore = new Acme\Person("Honore Hounwanou");
$florent = new Acme\Person("Florent Lacrotte");


$barcelona = new Acme\Team("Barcelona");
$realMadrid = new Acme\Team("Real Madrid");

$honore->favorite($realMadrid);
$honore->favorite($barcelona);
$florent->favorite($realMadrid);


echo  $barcelona->getName() . ' a ' . $barcelona->getNbFan() . ' fans ' . PHP_EOL;
echo  $realMadrid->getName() . ' a ' . $realMadrid->getNbFan() . ' fans ' . PHP_EOL;

$liga = new Acme\League("Liga");

$liga->addTeam($barcelona);
$liga->addTeam($realMadrid);

echo $liga->getTeamCount() . PHP_EOL;