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
        return sprintf(" %s ...", $troncate);
    }

    /**
     * @param string $content
     * @return string
     * @internal
     *  Removes the first letter but keeps the html tags
     */
    public function deleteFirstLetter($content)
    {
        $contentStrip = strip_tags($content);
        $firstCarac = $contentStrip{0};
        $stringWithoutFirst = explode($firstCarac, $content, 2);
        return $stringWithoutFirst[1];
    }

    /**
     * @param string $content
     * @return string
     */
    public function onlyFirstLetter($content)
    {
        $content = strip_tags($content);
        $firstCarac = $content{0};
        return ucfirst($firstCarac);
    }

}