<?php

namespace Framework\Http;

class Request
{
    /**
     * @var array $query
     */
    private $query;

    /**
     * @var array $request
     */
    private $request;

    /**
     * @var array $server
     */
    private $server;

    /**
     * Request constructor.
     * @param array $query
     * @param array $request
     * @param array $server
     */
    public function __construct(array $query, array $request, array $server)
    {
        $this->query = $query; //$_GET
        $this->request = $request; //$_POST
        $this->server = $server; //$_SERVER
    }

    /**
     * @return Request
     */
    public static function createFromGlobals(): Request
    {
        return new Request ($_GET, $_POST, $_SERVER);
    }

    /**
     * @return array
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @return string
     */
    public function getPathInfo()
    {
        return $this->server["PATH_INFO"];
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->server["REQUEST_METHOD"];
    }

    /**
     * @return string
     */
    public function getRequestUri()
    {
        return $this->server["REQUEST_URI"];
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param string $varEnv
     * @return string
     */
    public function getEnv($varEnv)
    {
        return getenv($varEnv);
    }
}