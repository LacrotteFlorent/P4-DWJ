<?php

namespace Acme;

class League
{
    private $name;
    private $teams;

    public function __construct($name) {
        $this->name = $name;
        $this->teams = [];
    }

    public function addTeam(Team $team) { // Le mot TEAM ici permet d'obliger l'utilisateur à passer un objet de la class Team dans le constructeur
        $this->teams [] = $team;
    }

    public function getTeamCount() {
        return count($this->teams);
    }
}