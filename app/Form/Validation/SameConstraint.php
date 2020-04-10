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

class SameConstraint extends Constraint
{

    /**
     * @var mixed
     */
    private $baseValue;

    public function __construct($baseValue)
    {
        $this->baseValue = $baseValue;
        self::$assert = Assert::lazy();
        self::$extendAssert = ExtendAssert::lazy();
    }

    /**
     * @param mixed $testValue
     * @param string $nameValue
     * @return bool
     */
    public function test($testValue, $nameValue) : bool
    {
        if(self::$assert->that($testValue, $nameValue)->tryAll()->same($this->baseValue)){
            return true;
        }
        return false;
    }

}