<?php


class Triangle extends Forme
{
    private $base = 4;
    private $hauteur = 2;

    /* aire d'un triangle = (base* hauteur) / 2 */
    public function aire()
    {
        return ($this->base * $this->hauteur)/2;
    }
}