<?php

namespace Project\Model;

use Framework\Form\Validation\IntegerOrNullConstraint;
use Framework\Form\Validation\NotBlankConstraint;
use Framework\Form\Validation\StringConstraint;
use Framework\Form\Validation\EmailConstraint;
use Framework\Form\Validation\DateConstraint;
use Framework\ORM\Model;
use Project\Manager\ContactManager;

class ContactModel extends Model
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
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \Datetime
     */
    private $sentAt;

    /**
     * @return array
     */
    public static function metadata()
    {
        return [
            "table"             =>"contact",
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
                "subject"       =>[
                    "type"          =>"string",
                    "property"      =>"subject",
                    "constraints"   => [new StringConstraint()]
                ],
                "content"       =>[
                    "type"          =>"string",
                    "property"      =>"content",
                    "constraints"   => [new StringConstraint()]
                ],
                "sent_at"       =>[
                    "type"          =>"datetime",
                    "property"      =>"sentAt",
                    "constraints"   => [new DateConstraint($_ENV["DATE_FORMAT"]), new NotBlankConstraint()]
                ]
            ]
        ];
    }

    /**
     * @return Manager
     */
    public static function getManager()
    {
        return ContactManager::class;
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
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
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
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * @param \Datetime $sentAt
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;
    }

}