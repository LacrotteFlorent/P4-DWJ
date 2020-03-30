<?php

namespace Project\Model;

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
                    "type"      =>"integer",
                    "property"  =>"id",
                    "assert"    =>"integerOrNull"
                ],
                "content"       =>[
                    "type"      =>"string",
                    "property"  =>"content",
                    "assert"    =>"string"
                ],
                "posted_at"     =>[
                    "type"      =>"datetime",
                    "property"  =>"postedAt",
                    "assert"    =>"date"
                ],
                "valid"         =>[
                    "type"      =>"bool",
                    "property"  =>"valid",
                    "assert"    =>"integer"
                ],
                "report"        =>[
                    "type"      =>"bool",
                    "property"  =>"report",
                    "assert"    =>"integer"
                ],
                "author"        =>[
                    "type"      =>"string",
                    "property"  =>"author",
                    "assert"    =>"stringOrNull"
                ],
                "post_id"       =>[
                    "type"      =>"integer",
                    "property"  =>"postId",
                    "assert"    =>"integer"
                ],
                "user_id"       =>[
                    "type"      =>"integerOrNull",
                    "property"  =>"userId",
                    "assert"    =>"integerOrNullOrZero"
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