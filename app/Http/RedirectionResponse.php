<?php

namespace Framework\Http;

class RedirectionResponse implements ResponseInterface
{
    private $uri;

    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    public function send()
    {
        header("Location: " . $this->uri);
        die;
    }
}