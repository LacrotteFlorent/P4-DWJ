<?php

namespace Framework\Form\Validation;


abstract class Constraint
{

    abstract public function test($value) : bool;
    
}
