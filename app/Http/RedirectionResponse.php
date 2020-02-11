<?php

namespace Framework\Http;

class RedirectionResponse implements ResponseInterface
{
    /**
     * @var string
     */
    private $uri;

    /**
     * RedirectionResponse constructor.
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return header
     */
    public function send()
    {
        dd($this->uri);
        header("Location: " . $this->uri);
        die;
    }
}