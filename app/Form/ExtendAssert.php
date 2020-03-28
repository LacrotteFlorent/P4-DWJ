<?php

namespace Framework\Form;


use \Assert\Assert;
use \Assert\LazyAssertionException;

class ExtendAssert extends Assert
{

    ///** @var string */
    //protected static $lazyAssertionExceptionClass = LazyAssertionException::class;

    /** @var string */
    protected static $assertionClass = ExtendAssertion::class;

}