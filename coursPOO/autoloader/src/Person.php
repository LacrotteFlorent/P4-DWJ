<?php


namespace Acme;

class Person
{
    private $name;

    public function favorite(Team $team) {
        $team->favorite();
    }
}