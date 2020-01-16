<?php

if(! function_exists('random_number')) {
    function random_number() {
        return rand(0, 100);
    }
}