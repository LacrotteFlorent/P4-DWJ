<?php

require "./vendor/autoload.php";

(new Chien)->communiquer();
(new Chat)->communiquer();


function toto(Animal $animal)
{
    $animal->communiquer();
}

toto(new Chat);