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

class NotZeroConstraint extends Constraint
{

    /**
     * @param mixed $testValue
     * @param string $nameValue
     * @return bool
     */
    public function test($testValue, $nameValue) : bool
    {
        if(self::$assert->that($testValue, $nameValue)->tryAll()->notSame($testValue, 0)){
            return true;
        }
        return false;
    }

}