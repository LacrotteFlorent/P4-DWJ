<?php

namespace Project\Model;

use Framework\ORM\Model;
use Project\Manager\ImageManager;

class ImageModel extends Model
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $alt;

    /**
     * @return array
     */
    public static function metadata()
    {
        return [
            "table"             =>"image",
            "primaryKey"        =>"id",
            "columns"           =>[
                "id"            =>[
                    "type"      =>"integer",
                    "property"  =>"id"
                ],
                "name"          =>[
                    "type"      =>"string",
                    "property"  =>"name"
                ],
                "alt"           =>[
                    "type"      =>"string",
                    "property"  =>"alt"
                ]
            ]
        ];
    }

    /**
     * @return Manager
     */
    public static function getManager()
    {
        return ImageManager::class;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

}