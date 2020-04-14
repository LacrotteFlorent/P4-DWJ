<?php

namespace Project\Model;

use Framework\Form\Validation\IntegerOrNullConstraint;
use Framework\Form\Validation\NotBlankConstraint;
use Framework\Form\Validation\StringConstraint;
use Framework\Form\Validation\EmailConstraint;
use Framework\Form\Validation\DateConstraint;
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
     * @var int
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
                    "type"          =>"integer",
                    "property"      =>"id",
                    "constraints"   => [new IntegerOrNullConstraint()]
                ],
                "full_name"     =>[
                    "type"          =>"string",
                    "property"      =>"fullName",
                    "constraints"   => [new StringConstraint()]
                ],
                "email"         =>[
                    "type"          =>"string",
                    "property"      =>"email",
                    "constraints"   => [new EmailConstraint()]
                ],
                "signed_at"     =>[
                    "type"          =>"datetime",
                    "property"      =>"signedAt",
                    "constraints"   => [new DateConstraint($_ENV["DATE_FORMAT"]), new NotBlankConstraint()]
                ],
                "user_id"       =>[
                    "type"          =>"string",
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