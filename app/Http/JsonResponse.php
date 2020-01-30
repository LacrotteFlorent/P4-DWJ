<?php

namespace Framework\Http;

class JsonResponse implements ResponseInterface
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function send()
    {
        echo json_encode($this->data);
    }

}