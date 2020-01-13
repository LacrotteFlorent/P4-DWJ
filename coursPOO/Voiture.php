<?php

class Voiture
{
    private $marque;
    private $couleur;

    public function demarrer()
    {
        echo "Vroum vroum";
    }

    public function arreter()
    {
        echo "Pummm";
    }

    public function Klaxonner()
    {
        echo "Pimm pim!!";
    }

    protected function relierFilBleuAuFilRouge()
    {

    }
}