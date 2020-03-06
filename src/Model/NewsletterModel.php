<?php

namespace Project\Model;

use Framework\ORM\Model;
use Project\Manager\NewsletterManager;

class NewsletterModel extends Model
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \Datetime
     */
    private $signedAt;

    /**
     * @var sint
     */
    private $userId;

    /**
     * @return array
     */
    public static function metadata()
    {
        return [
            "table"             =>"newsletter",
            "primaryKey"        =>"id",
            "columns"           =>[
                "id"            =>[
                    "type"      =>"integer",
                    "property"  =>"id"
                ],
                "full_name"     =>[
                    "type"      =>"string",
                    "property"  =>"fullName"
                ],
                "email"         =>[
                    "type"      =>"string",
                    "property"  =>"email"
                ],
                "signed_at"     =>[
                    "type"      =>"datetime",
                    "property"  =>"signedAt"
                ],
                "user_id"       =>[
                    "type"      =>"string",
                    "property"  =>"userId"
                ]
            ]
        ];
    }

    /**
     * @return Manager
     */
    public static function getManager()
    {
        return NewsletterManager::class;
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
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return \Datetime
     */
    public function getSignedAt()
    {
        return $this->signedAt;
    }

    /**
     * @param \Datetime $signedAt
     */
    public function setSignedAt($signedAt)
    {
        $this->signedAt = $signedAt;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

}