<?php

namespace Project\Model;

use Framework\Form\Validation\IntegerOrNullConstraint;
use Framework\Form\Validation\StringConstraint;
use Framework\Form\Validation\EmailConstraint;
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
     * @var string
     */
    private $role;

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
                    "type"          =>"integer",
                    "property"      =>"id",
                    "constraints"   => [new IntegerOrNullConstraint()]
                ],
                "email"         =>[
                    "type"          =>"string",
                    "property"      =>"email",
                    "constraints"   => [new EmailConstraint()]
                ],
                "password"      =>[
                    "type"          =>"string",
                    "property"      =>"password",
                    "constraints"   => [new StringConstraint()]
                ],
                "username"      =>[
                    "type"          =>"string",
                    "property"      =>"username",
                    "constraints"   => [new StringConstraint()]
                ],
                "role"          =>[
                    "type"          =>"string",
                    "property"      =>"role",
                    "constraints"   => [new StringConstraint()]
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

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

}