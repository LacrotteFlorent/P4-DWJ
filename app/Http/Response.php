<?php

namespace Framework\Http;

class Response implements ResponseInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * Response constructor.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     *@return echo
     */
    public function send()
    {
        echo $this->content;
    }
}