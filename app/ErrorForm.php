<?php

namespace Framework;

class ErrorForm implements \Countable, \Iterator
{

    /**
     * @var ErrorForm
     */
    private static $errorFormInstance;

    /**
     * @var array
     */
    private $messages = [];

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @return ErrorForm
     */
    public static function getInstance() : ErrorForm
    {
        if(!self::$errorFormInstance) {
            self::$errorFormInstance = new ErrorForm();
        }
        return self::$errorFormInstance;
    }

    /**
     * @param array $reload
     */
    public function add($reload)
    {
        array_push($this->messages, ['reload' => $reload]);
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