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

class DateConstraint extends Constraint
{

    /**
     * @var string
     */
    private $format;

    public function __construct($format)
    {
        $this->format = $format;
        self::$assert = Assert::lazy();
        self::$extendAssert = ExtendAssert::lazy();
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function test($testValue, $nameValue) : bool
    {
        if(is_object($testValue)){
            if(self::$assert->that($testValue, $nameValue)->tryAll()->objectOrClass()){
                return true;
            }
        }
        else{
            if(self::$assert->that($testValue, $nameValue)->tryAll()->date($this->format)){
                return true;
            }
        }
        
        return false;
    }

}