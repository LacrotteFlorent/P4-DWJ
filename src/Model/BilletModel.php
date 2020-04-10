<?php

namespace Project\Model;

use Framework\Form\Validation\IntegerOrNullConstraint;
use Framework\Form\Validation\NotBlankConstraint;
use Framework\Form\Validation\IntegerConstraint;
use Framework\Form\Validation\StringConstraint;
use Framework\Form\Validation\DateConstraint;
use Framework\ORM\Model;
use Project\Manager\BilletManager;

class BilletModel extends Model
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $postedAt;

    /**
     * @var bool
     */
    private $draft;

    /**
     * @var integer
     */
    private $likeCount;

    /**
     * @var integer
     */
    private $viewCount;

    /**
     * @var integer
     */
    private $imageId;

    /**
     * @return array
     */
    public static function metadata()
    {
        return [
            "table"             =>"post",
            "primaryKey"        =>"id",
            "columns"           =>[
                "id"            =>[
                    "type"          =>"integer",
                    "property"      =>"id",
                    "constraints"   => [new IntegerOrNullConstraint()]
                ],
                "title"         =>[
                    "type"          =>"string",
                    "property"      =>"title",
                    "constraints"   => [new StringConstraint()]
                ],
                "content"       =>[
                    "type"          =>"string",
                    "property"      =>"content",
                    "constraints"   => [new StringConstraint()]
                ],
                "created_at"    =>[
                    "type"          =>"datetime",
                    "property"      =>"createdAt",
                    "constraints"   => [new DateConstraint($_ENV["DATE_FORMAT"]), new NotBlankConstraint()]
                ],
                "posted_at"     =>[
                    "type"          =>"datetime",
                    "property"      =>"postedAt",
                    "constraints"   => [new DateConstraint($_ENV["DATE_FORMAT"]), new NotBlankConstraint()]
                ],
                "draft"         =>[
                    "type"          =>"bool",
                    "property"      =>"draft",
                    "constraints"   => [new IntegerConstraint(), new NotBlankConstraint()]
                ],
                "like_count"    =>[
                    "type"          =>"integer",
                    "property"      =>"likeCount",
                    "constraints"   => [new IntegerConstraint(), new NotBlankConstraint()]
                ],
                "view_count"    =>[
                    "type"          =>"integer",
                    "property"      =>"viewCount",
                    "constraints"   => [new IntegerConstraint(), new NotBlankConstraint()]
                ],
                "image_id"      =>[
                    "type"          =>"integer",
                    "property"      =>"imageId",
                    "constraints"   => [new IntegerOrNullConstraint()]
                ]
            ]
        ];
    }

    /**
     * @return Manager
     */
    public static function getManager()
    {
        return BilletManager::class;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * @param \DateTime $postedAt
     */
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;
    }

    /**
     * @return bool
     */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * @param bool $draft
     */
    public function setDraft($draft)
    {
        $this->draft = $draft;
    }

    /**
     * @return int
     */
    public function getLikeCount()
    {
        return $this->likeCount;
    }

    /**
     * @param int $likeCount
     */
    public function setLikeCount($likeCount)
    {
        $this->likeCount = $likeCount;
    }

    /**
     * @return int
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @param int $viewCount
     */
    public function setViewCount($viewCount)
    {
        $this->viewCount = $viewCount;
    }

    /**
     * @return int
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * @param int $imageId
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;
    }

}