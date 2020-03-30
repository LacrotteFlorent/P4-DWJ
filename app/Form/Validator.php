<?php

namespace Framework\Form;

use \Assert\Assert;
use \Assert\Assertion;
use \Assert\SoftAssertion;
use \Assert\LazyAssertionException;
use Framework\Form\ExtendAssert;
use Framework\Form\ExtendAssertion;
use Framework\Form\FormException;
use Framework\Form\ErrorForm;
use Framework\FlashBag;

class Validator
{

    /**
     * @var Assert
     */
    private $assert;

    /**
     * @var ExtendAssert
     */
    private $extendAssert;

    /**
     * @var array
     */
    private $reload = [];

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->assert = Assert::lazy();
        $this->extendAssert = ExtendAssert::lazy();
    }

    /**
     * @source https://github.com/beberlei/assert/blob/master/README.md
     * 
     * @uses $this->check()
     * @uses ErrorForm
     * @uses Flashbag
     * 
     * @param array|null $model
     * @param array|null $asserts
     * 
     * @internal 
     *  Checks the data of a form according to a Model and
     *  a data table if the model is not sufficient.
     * 
     *  To test an image, add in the image array 1 parameter (int) size.
     * 
     *  Fill in the $asserts table like this:
     * 
     * @example 
     *  asserts[
     *      name => [
     *          'value' => $valeurFormulaire,
     *          'assert => 'string'
     *          ],
     *      age => [
     *          'value' => $ageFormulaire,
     *          'assert => 'int'
     *          ],
     *   image1 => [
     *          'value' => $_FILES["imageToUpload"],
     *          'assert => 'image',
     *          'size'  => 1300000   // 13Mo
     *          ]
     *   ]
     * 
     * @throws FormException
     * 
     * @return bool $valid
     */
    public function assertion($model = null, $asserts = null)
    {
        if($model){
            foreach($model->metadata()["columns"] as $value => $column) {
                $testValue = $model->{sprintf("get%s", $column["property"])}();
                $this->check($column["assert"], $testValue, $value);
            }
        }

        if($asserts){
            foreach($asserts as $nameValue => $assert) {
                if(isset($assert["value"], $assert["assert"])){
                    $this->check($assert["assert"], $assert["value"], $nameValue, $assert);
                }
                else{
                    throw new FormException('The $asserts table of the assertion method is poorly implemented.');
                }
                
            }
        }

        try {
            $this->assert->verifyNow();
            $this->extendAssert->verifyNow();
            return true;
        } catch(\Exception $e) {
            foreach($e->getErrorExceptions() as $exception){
                $this->reload[$exception->getPropertyPath()] = "Erreur de saisie";
            }
            ErrorForm::getInstance()->add($this->reload);
            dump($e->getErrorExceptions());
            //dump($asserts);
            //dump(ErrorForm::getInstance());
            FlashBag::getInstance()->add("red", "Il y a eu une erreur dans la saisie de votre formulaire");
            return false;
        }
    }

    /**
     * @used-by $this->assertion()
     * 
     * @param string $assert
     * @param mixed $testValue
     * @param string $nameValue
     * @param array $params
     * 
     * @global SIZE_IMG
     * 
     * @throws FormException
     */
    private function check($assert, $testValue, $nameValue, $params = null)
    {
        $testValueString = (string) 'salut';
        $testValueInteger = 3;
        $testValueMail = 'bralocaz@gmail.com';

        switch ($assert) {
            case 'integer':
                $this->assert->that($testValue, $nameValue)->tryAll()->integer();
                $this->reload[$nameValue] = $testValue;
                break;

            case 'string':
                $this->assert->that($testValue, $nameValue)->tryAll()->string();
                $this->reload[$nameValue] = $testValue;
                break;

            case 'email':
                $this->assert->that($testValue, $nameValue)->tryAll()->email();
                $this->reload[$nameValue] = $testValue;
                break;

            case 'null':
                $this->assert->that($testValue, $nameValue)->tryAll()->null();
                $this->reload[$nameValue] = $testValue;
                break;

            case 'integerOrNull':
                if($testValue != null){
                    $this->assert->that($testValue, $nameValue)->tryAll()->integer();
                    $this->reload[$nameValue] = $testValue;
                }
                else{
                    $this->assert->that($testValue, $nameValue)->tryAll()->null();
                    $this->reload[$nameValue] = $testValue;
                }
                break;

            case 'integerOrNullOrZero':
                if($testValue != null){
                    $this->assert->that($testValue, $nameValue)->tryAll()->integer();
                    $this->reload[$nameValue] = $testValue;
                }
                elseif($testValue === 0){
                    $this->assert->that($testValue, $nameValue)->tryAll()->integer();
                    $this->reload[$nameValue] = $testValue;
                }
                else{
                    $this->assert->that($testValue, $nameValue)->tryAll()->null();
                    $this->reload[$nameValue] = $testValue;
                }
                break;
                
            case 'stringOrNull':
                if($testValue != null || $testValue === ""){
                    $this->assert->that($testValue, $nameValue)->tryAll()->string();
                    $this->reload[$nameValue] = $testValue;
                }
                else{
                    $this->assert->that($testValue, $nameValue)->tryAll()->null();
                    $this->reload[$nameValue] = $testValue;
                }
                break;
    
            case 'date':
                if(is_object($testValue)){
                    $this->assert->that($testValue, $nameValue)->tryAll()->objectOrClass();;
                    $this->reload[$nameValue] = $testValue;
                }
                else{
                    $this->assert->that($testValue, $nameValue)->tryAll()->date($_ENV["DATE_FORMAT"]);
                    $this->reload[$nameValue] = $testValue;
                }
                break;

            case 'image':
                if(!empty($params['name']) && !empty($params['size']) && !empty($params['type']) && !empty($params['tmp_name'])){
                    $this->extendAssert->that($testValue, $nameValue)->tryAll()->image($params['size']);
                    $this->reload[$nameValue] = $testValue;
                }
                break;

            case 'checkbox':
                $this->assert->that($testValue, $nameValue)->tryAll()->string()->same("on");
                $this->reload[$nameValue] = $testValue;
                break;
            
            case 'bool':
                $this->assert->that($testValue, $nameValue)->tryAll()->boolean();
                $this->reload[$nameValue] = $testValue;
                break;

            default:
                throw new FormException ("This type of variable is not yet supported by this method");
                break;
        }
    }

}