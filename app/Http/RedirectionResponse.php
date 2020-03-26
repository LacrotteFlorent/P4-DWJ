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
        $this->send();
    }

    /**
     * @return header
     */
    public function send()
    {
        header(sprintf("location: %s", $this->uri));
    }
}