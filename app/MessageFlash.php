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
     * @return MessageFlash
     */
    public static function getInstance() : MessageFlash
    {
        if(!self::$messageFlashInstance) {
            self::$messageFlashInstance = new MessageFlash();
        }
        return self::$messageFlashInstance;
    }

    /**
     * MessageFlash constructor.
     * @return MessageFlash $_SESSION
     */
    public function __construct()
    {
        $_SESSION["FLASH_MESSAGES"] = self::$messageFlashInstance;
    }

    /**
     * @param string $type
     * @param string $message
     * @return MessageFlash $_SESSION
     */
    public function add($type, $message)
    {
        array_push($this->messages, ['type' => $type, 'message' => $message]);
        $_SESSION["FLASH_MESSAGES"] = self::$messageFlashInstance;
    }

    /**
     * @return array
     */
    public function getMessage()
    {
        $affiche = array_shift($this->messages);
        return $affiche;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        $affiche = [];
        foreach($this->messages as $message){
            array_push($affiche, array_shift($this->messages));
        }
        return $affiche;
    }

}