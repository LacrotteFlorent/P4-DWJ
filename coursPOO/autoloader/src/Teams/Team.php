<?php

namespace Acme\Teams;

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

    public function favorite() {
        $this->nbFan ++;
    }

}