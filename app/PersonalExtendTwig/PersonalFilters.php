<?php

namespace Framework\PersonalExtendTwig;

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
            new TwigFilter('truncate', [$this, 'truncate']),
            new TwigFilter('deleteFirstLetter', [$this, 'deleteFirstLetter']),
            new TwigFilter('onlyFirstLetter', [$this, 'onlyFirstLetter'])
        ];
    }

    /**
     * @param string $content
     * @param int $nbCarac
     * @return string
     */
    public function truncate($content, $nbCarac)
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

}