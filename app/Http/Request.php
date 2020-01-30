<?php

namespace Framework\Http;

class Request
{
    private $query;

    private $request;

    private $server;

    public function __construct(array $query, array $request, array $server)
    {
        $this->query = $query;
        $this->request = $request;
        $this->server = $server;
    }

    public static function createFromGlobals(): Request
    {
        return new Request ($_GET, $_POST, $_SERVER);
    }
}


//factory patern