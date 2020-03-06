<?php

namespace Project\Model;

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
                "subject"       =>[
                    "type"      =>"string",
                    "property"  =>"subject"
                ],
                "content"       =>[
                    "type"      =>"string",
                    "property"  =>"content"
                ],
                "sent_at"       =>[
                    "type"      =>"datetime",
                    "property"  =>"sentAt"
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