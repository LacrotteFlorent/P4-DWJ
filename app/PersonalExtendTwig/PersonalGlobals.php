<?php

namespace Framework\PersonalExtendTwig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Framework\Form\ErrorForm;
use Framework\FlashBag;

class PersonalGlobals extends AbstractExtension implements GlobalsInterface
{

    /**
      * @return array
      * @source https://twig.symfony.com/doc/2.x/advanced.html#id1
      */
    public function getGlobals() : array
    {
        if(!empty($_SESSION['login'])){
            return [    
                "FLASHBAG"  => FlashBag::getInstance(),
                "ERRORFORM" => ErrorForm::getInstance(),
                "LOGIN"     => $_SESSION['login']
            ];
        }
        else{
            return [    
                "FLASHBAG"  => FlashBag::getInstance(),
                "ERRORFORM" => ErrorForm::getInstance()
            ];
        }
    }

}