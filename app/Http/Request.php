<?php

namespace Framework\Http;

class Request
{
    private $query;

    private $request;

    private $server;

    public function __construct(array $query, array $request, array $server)
    {
        $this->query = $query; //$_GET
        $this->request = $request; //$_POST
        $this->server = $server; //$_SERVER
    }

    public static function createFromGlobals(): Request
    {
        return new Request ($_GET, $_POST, $_SERVER);
    }

    public function getServer(){
        return $this->server;
    }


}


//factory patern