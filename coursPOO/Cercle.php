<?php


class Cercle extends Forme
{
    private $rayon = 3;

    public function aire()
    {
        return pi() * pow($this->rayon, 2);
    }
}