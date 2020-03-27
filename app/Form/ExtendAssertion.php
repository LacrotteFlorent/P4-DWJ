<?php

namespace Framework\Form;

use \Assert\Assertion;
use \Assert\LazyAssertion;
use Framework\Flashbag;

class ExtendAssertion extends Assertion
{

    const INVALID_IMAGE = 300;

    
    /**
     * Assert that the value is a valid image.
     *
     * @param string $value
     * @param string|callable|null $message
     * @param string|null $propertyPath
     * @param int $size
     *
     * @return bool
     *
     * @throws AssertionFailedException
     */
    public static function image($value, $size, $message = null, string $propertyPath = null): bool
    {
        static::isArray($value, $message, $propertyPath);

        if((($value['type'] == "image/gif")
                    || ($value['type'] == "image/jpeg")
                    || ($value['type'] == "image/pjpeg")
                    || ($value['type'] == "image/png"))
                    && ($value['size'] < $value['size']))
                    {
                        if($value["error"] > 0){
                            $message = \sprintf(
                                static::generateMessage($message ?: 'Path "%s" was expected, there was an error uploading the image'),
                                static::stringify($value)
                            );
                
                            throw static::createException($value, $message, static::INVALID_IMAGE, $propertyPath);
                        }
                        else{
                            if (file_exists("public/img/" . $value["name"]))
                            {
                                $message = \sprintf(
                                    static::generateMessage($message ?: 'Path "%s" was expected, the image already exists.'),
                                    static::stringify($value)
                                );
                    
                                throw static::createException($value, $message, static::INVALID_IMAGE, $propertyPath);
                            }
                        }
                    }
                else{
                    $message = \sprintf(
                        static::generateMessage($message ?: 'Path "%s" was expected, the image file is invalid.'),
                        static::stringify($value)
                    );
        
                    throw static::createException($value, $message, static::INVALID_IMAGE, $propertyPath);
                }

        return true;
    }
}