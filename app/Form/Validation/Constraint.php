<?php

namespace Framework\Form\Validation;

use \Assert\Assert;
use \Assert\Assertion;
use \Assert\SoftAssertion;
use \Assert\LazyAssertionException;
use Framework\Form\ExtendAssert;
use Framework\Form\ExtendAssertion;
use Framework\Form\FormException;

abstract class Constraint
{

    abstract public function test($testValue, $nameValue) : bool;

    /**
     * @var Assert
     */
    protected static $assert;

    /**
     * @var ExtendAssert
     */
    protected static $extendAssert;

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        self::$assert = Assert::lazy();
        self::$extendAssert = ExtendAssert::lazy();
    }

    /**
     * @return Assert
     */
    public function getAssert()
    {
        return self::$assert;
    }

}
