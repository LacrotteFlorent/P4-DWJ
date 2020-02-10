<?php

namespace Framework\Http;

class JsonResponse implements ResponseInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * JsonResponse constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return echo
     */
    public function send()
    {
        echo json_encode($this->data);
    }

}