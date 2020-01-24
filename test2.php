<?php

require './test.php';
require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;

dump($Florent);

?>
<!--
    
    
                                            HEADER



-->

<header class="row py-4">
    <div class="headband col-lg-12">
        <div class="row">
            <h1 class="titleFirstPart col-12">JEAN</h1>
            <h1 class="titleSecPart col-12">FORTEROCHE</h1>
            <div class="splitter col-12">
                <div class="row">
                    <div class="spaceSplit col-1"></div>
                    <div class="split col-10"></div>
                    <div class="spaceSplit col-1"></div>
                </div>
            </div>
            <nav class="col-12">
                <div class="row">
                    <div class="col-12">
                        {%set data = '<h1>Alors Alors</h1>%}
                        {{data}}
                        {{variableContentTest}}
                        <a href="./host.php">ACCUEIL</a>
                        <a href="./blog.php">BLOG</a>
                        <a href="./billet.php">BILLET</a>
                        <a href="./contact.php">CONTACT</a>
                    </div>
                </div>
            </nav>
            <div class="socialNetwork col-12">
                <div id="facebook" class="circle d-flex justify-content-center align-items-center">
                    <i class="fab fa-facebook-f"></i>
                </div>
                <div id="instagram" class="circle d-flex justify-content-center align-items-center">
                    <i class="fab fa-instagram"></i>
                </div>
                <div id="twitter" class="circle d-flex justify-content-center align-items-center">
                    <i class="fab fa-twitter"></i>
                </div>
            </div>
        </div>
    </div>
</header>