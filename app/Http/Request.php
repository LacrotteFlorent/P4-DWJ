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
     * @var array $post
     */
    private $post;

    /**
     * Request constructor.
     * @param array $query
     * @param array $request
     * @param array $server
     */
    public function __construct(array $query, array $request, array $server, array $post)
    {
        $this->query = $query; //$_GET
        $this->request = $request; //$_REQUEST
        $this->server = $server; //$_SERVER
        $this->post = $post; //$_POST
    }

    /**
     * @return Request
     */
    public static function createFromGlobals(): Request
    {
        return new Request ($_GET, $_REQUEST, $_SERVER, $_POST);
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
     * @return array
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
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