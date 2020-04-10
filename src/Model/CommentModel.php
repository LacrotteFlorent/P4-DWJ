<?php

namespace Project\Model;

use Framework\Form\Validation\IntegerOrNullConstraint;
use Framework\Form\Validation\NotBlankConstraint;
use Framework\Form\Validation\IntegerConstraint;
use Framework\Form\Validation\StringConstraint;
use Framework\Form\Validation\DateConstraint;
use Framework\ORM\Model;
use Project\Manager\CommentManager;

class CommentModel extends Model
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $postedAt;

    /**
     * @var bool
     */
    private $valid;

    /**
     * @var bool
     */
    private $report;

    /**
     * @var string
     */
    private $author;

    /**
     * @var int
     */
    private $postId;

    /**
     * @var int
     */
    private $userId;

    /**
     * @return array
     */
    public static function metadata()
    {
        return [
            "table"             =>"comment",
            "primaryKey"        =>"id",
            "columns"           =>[
                "id"            =>[
                    "type"          =>"integer",
                    "property"      =>"id",
                    "constraints"   => [new IntegerOrNullConstraint()]
                ],
                "content"       =>[
                    "type"          =>"string",
                    "property"      =>"content",
                    "constraints"   => [new StringConstraint(), new NotBlankConstraint()]
                ],
                "posted_at"     =>[
                    "type"          =>"datetime",
                    "property"      =>"postedAt",
                    "constraints"   => [new DateConstraint($_ENV["DATE_FORMAT"]), new NotBlankConstraint()]
                ],
                "valid"         =>[
                    "type"          =>"bool",
                    "property"      =>"valid",
                    "constraints"   => [new IntegerConstraint(), new NotBlankConstraint()]
                ],
                "report"        =>[
                    "type"          =>"bool",
                    "property"      =>"report",
                    "constraints"   => [new IntegerConstraint(), new NotBlankConstraint()]
                ],
                "author"        =>[
                    "type"          =>"string",
                    "property"      =>"author",
                    "constraints"   => [new StringConstraint()]
                ],
                "post_id"       =>[
                    "type"          =>"integer",
                    "property"      =>"postId",
                    "constraints"   => [new IntegerConstraint(), new NotBlankConstraint()]
                ],
                "user_id"       =>[
                    "type"          =>"integerOrNull",
                    "property"      =>"userId",
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
        return CommentManager::class;
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
     * @return \Datetime
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * @param \Datetime $postedAt
     */
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;
    }

    /**
     * @return bool
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return bool
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @param bool $report
     */
    public function setReport($report)
    {
        $this->report = $report;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return integer
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param integer $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param integer $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

}