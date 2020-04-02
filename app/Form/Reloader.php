<?php

namespace Framework\Form;

class Reloader implements \Countable
{

    /**
     * @var Realoader
     */
    private static $reloaderInstance;

    /**
     * @var array
     */
    private $messages = [];


    /**
     * @global $_SESSION['RELOAD'] => Stores the instance in session
     * @return Reloader
     */
    public static function getInstance() : Reloader
    {
        if(isset($_SESSION["RELOAD"])){
            self::$reloaderInstance = $_SESSION["RELOAD"];
        }

        if(!self::$reloaderInstance) {
            self::$reloaderInstance = new Reloader();
            $this->messages[0] ="";
        }
        return self::$reloaderInstance;
    }

    public static function pushInSession(){
        $_SESSION["RELOAD"] = self::$reloaderInstance;
    }

    /**
     * @param array $reload
     */
    public function add($reload)
    {
        $this->messages[0] = $reload;
        $this->pushInSession();
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @inheritDoc
     * @source https://www.php.net/manual/fr/class.countable.php
     */
    public function count()
    {
        return count($this->messages);
    }

}