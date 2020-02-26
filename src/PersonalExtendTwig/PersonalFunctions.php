<?php

namespace Project\PersonalExtendTwig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PersonalFunctions extends AbstractExtension
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    /**
     * @return array
     * @source https://symfony.com/doc/current/templating/twig_extension.html
     * @note [Retourne les fonctions crées dans l'extension]
     * [fonction obligatoire pour twig]
     */
    public function getFunctions(){

        return [

            new TwigFunction('urlImage', [$this, 'urlImage']),
            new TwigFunction('altImage', [$this, 'altImage']),
            new TwigFunction('countParam', [$this, 'countParam']),

        ];
    }

    /**
     * @param int $idImage
     * @return string
     */
    public function urlImage($idImage)
    {
        $imageBillet = $this->database->getManager('\Project\Model\ImageModel')->find($idImage, "image");
        return $imageBillet->getName();
    }

    /**
     * @param $idImage
     * @return string
     */
    public function altImage($idImage)
    {
        $imageBillet = $this->database->getManager('\Project\Model\ImageModel')->find($idImage, "image");
        return $imageBillet->getAlt();
    }

    public function countParam($arrayOfValues, $getToCount)
    {
        $totalCount = 0;
        foreach ($arrayOfValues as $arrayOfValue){
            $totalCountLikes += $arrayOfValue->$getToCount;
        }
        return $totalCount;
    }

}
