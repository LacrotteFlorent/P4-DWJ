<?php

namespace Project\Model;

class BilletModel{

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


    public function __constructor()
    {

    }

    /**
     * @
     */
    public function metadata()
    {
        return [
            "table"             =>"post",
            "primaryKey"        =>"id",
            "columns"           =>[
                "id"            =>[
                    "type"      =>"integer",
                    "property"  =>"id"
                ],
                "title"         =>[
                    "type"      =>"string",
                    "property"  =>"title"
                ],
                "content"       =>[
                    "type"      =>"string",
                    "property"  =>"content"
                ],
                "created_at"    =>[
                    "type"      =>"datetime",
                    "property"  =>"createdAt"
                ],
                "posted_at"     =>[
                    "type"      =>"datetime",
                    "property"  =>"postedAt"
                ],
                "draft"         =>[
                    "type"      =>"bool",
                    "property"  =>"draft"
                ],
                "like_count"    =>[
                    "type"      =>"integer",
                    "property"  =>"likeCount"
                ],
                "view_count"    =>[
                    "type"      =>"integer",
                    "property"  =>"viewCount"
                ],
                "image_id"            =>[
                    "type"      =>"integer",
                    "property"  =>"imageId"
                ]
            ]
        ];
    }

    /**
     * @return Manager
     */
    public function getManager()
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * @return bool
     */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * @return integer
     */
    public function getLikeCount()
    {
        return $this->likeCount;
    }

    /**
     * @return integer
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @return integer
     */
    public function getImageId()
    {
        return $this->imageId;
    }

}