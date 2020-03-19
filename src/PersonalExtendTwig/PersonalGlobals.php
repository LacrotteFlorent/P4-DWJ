<?php

namespace Project\PersonalExtendTwig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Framework\FlashBag;

class PersonalGlobals extends AbstractExtension implements GlobalsInterface
{

    /**
      * @return array
      * @source https://twig.symfony.com/doc/2.x/advanced.html#id1
      * @note [Retourne les variables globales crées dans l'extension]
      * [fonction obligatoire pour twig]
      */
    public function getGlobals() : array
    {
        return [    
            "FLASHBAG" => FlashBag::getInstance(),
        ];
    }

}