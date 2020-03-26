<?php

namespace Framework;

class FlashBag implements \Countable, \Iterator
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
     * @var int
     */
    private $position = 0;

    /**
     * @return FlashBag
     */
    public static function getInstance() : FlashBag
    {
            
        if(isset($_SESSION["FLASHBAG"])){
            self::$flashBagInstance = $_SESSION["FLASHBAG"];
        }

        if(!self::$flashBagInstance) {
            self::$flashBagInstance = new FlashBag();
        }
        return self::$flashBagInstance;
    }

    public static function pushInSession(){
        $_SESSION["FLASHBAG"] = self::$flashBagInstance;
    }

    /**
     * @param string $type
     * @param string $message
     */
    public function add($type, $message)
    {
        array_push($this->messages, ['type' => $type, 'message' => $message]);
        $this->pushInSession();
    }

    /**
     * @inheritDoc
     * @source https://www.php.net/manual/fr/class.countable.php
     */
    public function count()
    {
        return count($this->messages);
    }

    /**
     * @source https://www.php.net/manual/fr/class.iterator.php
     * @todo Go head of array
     * @return void
     */
    public function rewind() : void
    {
        $this->position = 0;
    }

    /**
     * @todo Return current element
     * @return mixed $message
     */
    public function current()
    {

        return array_shift($this->messages);
    }

    /**
     * @return mixed $position
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @todo Return next element
     * @return void
     */
    public function next() : void
    {
        $this->position = 0;
    }

    /**
     * @todo Return current position if valid
     * @return bool
     */
    public function valid() : bool
    {
        return isset($this->messages[$this->position]);
    }

}