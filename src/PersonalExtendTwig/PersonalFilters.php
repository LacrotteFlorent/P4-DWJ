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
            new TwigFilter('deleteFirstLetter', [$this, 'deleteFirstLetter']),
            new TwigFilter('onlyFirstLetter', [$this, 'onlyFirstLetter']),
            new TwigFilter('ifNullIsGuest', [$this, 'ifNullIsGuest']),

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

    /**
     * @param string $content
     * @return string
     */
    public function deleteFirstLetter($content)
    {
        $stringWithoutFirst = substr($content, 1);
        return $stringWithoutFirst;
    }

    /**
     * @param string $caracString
     * @return string
     */
    public function onlyFirstLetter($content)
    {
        $firstCarac = $content{0};
        return ucfirst($firstCarac);
    }

    /**
     * @param string $author
     * @return string
     */
    public function ifNullIsGuest($author)
    {
        if(!$author){
            $author = "Guest";
        }

        return $author;
    }

}