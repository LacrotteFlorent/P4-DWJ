<?php


namespace Acme;

use Acme\Teams\Team;

class Person
{
    private $name;

    public function __construct($name, \Song $sonFavori) {  // \Song car song se trouve dans le namespace Global   ou utiliser use Song
        $this->name = $name;
    }

    public function favorite(Team $team) {
        $team->favorite();
    }
}