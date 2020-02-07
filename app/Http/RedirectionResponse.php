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
        dd($this->uri);
        header("Location: " . $this->uri);
        die;
    }
}