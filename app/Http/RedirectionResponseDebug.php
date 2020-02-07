<?php

namespace Framework\Http;

class RedirectionResponseDebug implements ResponseInterface
{
    private $uri;

    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    public function send()
    {
        $contenu=file_get_contents(" localhost" .  $this->uri . ".php");
        dd($contenu);
        echo"<br><br>Contenu du fichier $file : <br><pre>$contenu</pre>";
        die;
    }
}