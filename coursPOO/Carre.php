<?php


class Carre extends Forme
{
    private $cote = 4;

    /* aire d'un carre = cote au carre */
    public function aire()
    {
        return pow($this->cote, 2);
    }
}