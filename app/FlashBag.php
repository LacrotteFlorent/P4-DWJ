<?php

namespace Framework;

class FlashBag implements \Iterator
{

    /**
     * @var FlashBag
     */
    private static $flashBagInstance;

    /**
     * @var array
     */
    private $messages = [];

    /**
     * @return FlashBag
     */
    public static function getInstance() : FlashBag
    {
        if(!self::$flashBagInstance) {
            self::$flashBagInstance = new FlashBag();
        }
        return self::$flashBagInstance;
    }

    /**
     * MessageFlash constructor.
     * @return FlashBag $_SESSION
     */
    public function __construct()
    {
        $_SESSION["FLASH_MESSAGES"] = self::$flashBagInstance;
    }

    /**
     * @param string $type
     * @param string $message
     * @return FlashBag $_SESSION
     */
    public function add($type, $message)
    {
        array_push($this->messages, ['type' => $type, 'message' => $message]);
        $_SESSION["FLASH_MESSAGES"] = self::$flashBagInstance;
    }

    /**
     * @todo Go head of array
     */
    public function rewind()
    {
        reset($this->messages);
    }

    /**
     * @todo Return current element
     * @return mixed $message
     */
    public function current()
    {
        return array_shift($this->messages);//current($this->messages);
    }

    /**
     * @todo Return key of element
     * @return mixed $key
     */
    public function key()
    {
        return key($this->messages);
    }

    /**
     * @todo Return next element
     * @return mixed $message
     */
    public function next()
    {
        return current($this->messages); //next($this->messages);
    }

    /**
     * @todo Return current position if valid
     * @return bool
     */
    public function valid()
    {
        return (key($this->messages) !== NULL && key($this->messages) !== FALSE);
    }

}