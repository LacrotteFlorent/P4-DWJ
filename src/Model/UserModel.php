<?php

namespace Project\Model;

use Framework\ORM\Model;
use Project\Manager\UserManager;

class UserModel extends Model
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $username;

    /**
     * @return array
     */
    public static function metadata()
    {
        return [
            "table"             =>"user",
            "primaryKey"        =>"id",
            "columns"           =>[
                "id"            =>[
                    "type"      =>"integer",
                    "property"  =>"id",
                    "assert"    =>"integerOrNull"
                ],
                "email"         =>[
                    "type"      =>"string",
                    "property"  =>"email",
                    "assert"    =>"null"
                ],
                "password"      =>[
                    "type"      =>"string",
                    "property"  =>"password",
                    "assert"    =>"string"
                ],
                "username"      =>[
                    "type"      =>"string",
                    "property"  =>"username",
                    "assert"    =>"string"
                ]
            ]
        ];
    }

    /**
     * @return Manager
     */
    public static function getManager()
    {
        return UserManager::class;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

}