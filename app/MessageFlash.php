<?php

namespace Framework;

class MessageFlash
{

    /**
     * @var MessageFlash
     */
    private static $messageFlashInstance;

    /**
     * @var array
     */
    private $messages = [];

    /**
     * 
     */
    public static function getInstance() : MessageFlash
    {
        if(!self::$messageFlashInstance) {
            self::$messageFlashInstance = new MessageFlash();
        }
        return self::$messageFlashInstance;
    }

    /**
     * 
     */
    public function __construct()
    {
        $_SESSION["FLASH_MESSAGES"] = self::$messageFlashInstance;
    }

    /**
     * 
     */
    public function add($type, $message)
    {
        array_push($this->messages, ['type' => $type, 'message' => $message]);
        $_SESSION["FLASH_MESSAGES"] = self::$messageFlashInstance;
    }

    /**
     * 
     */
    public function getMessage()
    {
        $affiche = array_shift($this->messages);
        return $affiche;
    }

}