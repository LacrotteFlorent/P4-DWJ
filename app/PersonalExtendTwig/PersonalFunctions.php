<?php

namespace Framework\PersonalExtendTwig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PersonalFunctions extends AbstractExtension
{

    /**
     * @return array
     * @source https://symfony.com/doc/current/templating/twig_extension.html
     * @note [Retourne les fonctions crées dans l'extension]
     * [fonction obligatoire pour twig]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('dumpTwig', [$this, 'dumpTwig'])
        ];
    }

    /**
     * @param mixed $value
     * @return dump
     */
    public function dumpTwig($value)
    {
        return dump($value);
    }

}
