<?php

namespace Framework\Form;

use \Assert\Assertion;
use Framework\Flashbag;

class ExtendAssertion extends Assertion
{
    protected static $exceptionClass = 'Framework\Form\AssertionFailedException';

    const INVALID_IMAGE = 300;

    /**
     * Assert that the value is a valid image.
     *
     * @param string $value
     * @param string|callable|null $message
     * @param string|null $propertyPath
     *
     * @return bool
     *
     * @throws AssertionFailedException
     */
    public static function image($value, $size, $message = null, string $propertyPath = null): bool
    {
        static::isArray($value, $message, $propertyPath);

        if((($value['value']['type'] == "image/gif")
                    || ($value['value']['type'] == "image/jpeg")
                    || ($value['value']['type'] == "image/pjpeg")
                    || ($value['value']['type'] == "image/png"))
                    && ($value['value']['size'] < $value['size']))
                    {
                        if($value['value']["error"] > 0){
                            $flashMessage = (FlashBag::getInstance())->add("red", "OOPS, il y a eu une erreur dans le téléchargement de l'image !");
                            $message = \sprintf(
                                static::generateMessage($message ?: 'Path "%s" was expected to be IMAGE.'),
                                static::stringify($value)
                            );
                
                            throw static::createException($value, $message, static::INVALID_IMAGE, $propertyPath);
                        }
                        else{
                            if (file_exists("public/img/" . $value['value']["name"]))
                            {
                                $flashMessage = (FlashBag::getInstance())->add("red", "OOPS, l'image existe déja !");
                                $message = \sprintf(
                                    static::generateMessage($message ?: 'Path "%s" was expected to be IMAGE.'),
                                    static::stringify($value)
                                );
                    
                                throw static::createException($value, $message, static::INVALID_IMAGE, $propertyPath);
                            }
                        }
                    }
                else{
                    $flashMessage = (FlashBag::getInstance())->add("red", "OOPS, il y a eu une erreur, l'image' est invalide !");
                    $message = \sprintf(
                        static::generateMessage($message ?: 'Path "%s" was expected to be IMAGE.'),
                        static::stringify($value)
                    );
        
                    throw static::createException($value, $message, static::INVALID_IMAGE, $propertyPath);
                }

        return true;
    }
}