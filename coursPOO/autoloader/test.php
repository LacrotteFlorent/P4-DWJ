<?php

use Acme\Person;  // ou use Acme\{Person, Team, League};
use Acme\Teams\Team;
use Acme\League;

echo random_number() . PHP_EOL;

new Song;

// use Acme\Team as TeamAcme;    pour créer un alias

$honore = new Person("Honore Hounwanou", new Song);
$florent = new Person("Florent Lacrotte", new Song);


$barcelona = new Team("Barcelona");
$realMadrid = new Team("Real Madrid");

$honore->favorite($realMadrid);
$honore->favorite($barcelona);
$florent->favorite($realMadrid);


echo  $barcelona->getName() . ' a ' . $barcelona->getNbFan() . ' fans ' . PHP_EOL;
echo  $realMadrid->getName() . ' a ' . $realMadrid->getNbFan() . ' fans ' . PHP_EOL;

$liga = new League("Liga");

$liga->addTeam($barcelona);
$liga->addTeam($realMadrid);

echo $liga->getTeamCount() . PHP_EOL;