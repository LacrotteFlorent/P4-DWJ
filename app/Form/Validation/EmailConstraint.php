<?php

namespace Framework\Form\Validation;

use Framework\Form\Validation\Constraint;
use \Assert\Assert;
use \Assert\Assertion;
use \Assert\SoftAssertion;
use \Assert\LazyAssertionException;
use Framework\Form\ExtendAssert;
use Framework\Form\ExtendAssertion;
use Framework\Form\FormException;

class EmailConstraint extends Constraint
{

    /**
     * @param mixed $testValue
     * @param string $nameValue
     * @return bool
     */
    public function test($testValue, $nameValue) : bool
    {
        if(self::$assert->that($testValue, $nameValue)->tryAll()->email()){
            return true;
        }
        return false;
    }

}