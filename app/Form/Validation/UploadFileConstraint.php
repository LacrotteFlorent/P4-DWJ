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

class UploadFileConstraint extends Constraint
{

    /**
     * @var string | integer
     */
    private $size;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $tmp_name;

    public function __construct($size, $name, $type, $tmp_name)
    {
        $this->size = $size;
        $this->name = $name;
        $this->type = $type;
        $this->tmp_name = $tmp_name;
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
        if(!empty($this->name) && !empty($this->size) && !empty($this->type) && !empty($this->tmp_name)){
            if(self::$extendAssert->that($testValue, $nameValue)->tryAll()->image($this->size)){
                return true;
            }
        }
        return false;
    }

}