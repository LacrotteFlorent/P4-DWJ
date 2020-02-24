<?php

namespace Project\PersonalExtendTwig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class PersonalFilters extends AbstractExtension
{

   /**
     * @return array
     * @source https://symfony.com/doc/current/templating/twig_extension.html
     * @note [Retourne les filtres crées dans l'extension]
     * [fonction obligatoire pour twig]
     */
    public function getFilters(){

        return [

            new TwigFilter('troncate', [$this, 'troncate']),

        ];
    }

    /**
     * @param string $content
     * @param int $nbCarac
     * @return string
     */
    public function troncate($content, $nbCarac)
    {
        $troncate = substr($content, 0, $nbCarac);
        
        return $troncate . " ...";
    }

}