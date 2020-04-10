<?php

namespace Framework\Form\Validation;

use \Assert\Assert;
use \Assert\Assertion;
use \Assert\SoftAssertion;
use \Assert\LazyAssertionException;
use Framework\Form\ExtendAssert;
use Framework\Form\ExtendAssertion;
use Framework\Form\FormException;
use Framework\Form\Reloader;
use Framework\Form\ReCaptcha;
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
     * @uses ErrorForm
     * @uses Flashbag
     * 
     * @param array|null $model
     * @param array|null $constraints
     * @param bool|null $recaptcha
     * 
     * @internal 
     *  Checks the data of a form according to a Model and
     *  a data table if the model is not sufficient.
     * 
     *  Fill in the $constraints table like this:
     * 
     * @example 
     *  constraints[
     *      name => [
     *          'value' => $valeurFormulaire,
     *          'constraints' => [new StringConstraint(), new NotBlankConstraint()]
     *          ],
     *      age => [
     *          'value' => $uploadFile,
     *          'constraints' => [new UploadFileConstraint($_FILES["imageToUpload"]['size'],$_FILES["imageToUpload"]['name'],$_FILES["imageToUpload"]['type'],$_FILES["imageToUpload"]['tmp_name'])]
     *          ],
     *   ]
     * 
     * @throws FormException
     * 
     * @return bool $valid
     */
    public function assertion($model = null, $constraints = null, $recaptcha = null)
    {
        if($model){
            foreach($model->metadata()["columns"] as $value => $column) {
                $testValue = $model->{sprintf("get%s", $column["property"])}();
                foreach($column["constraints"] as $constraint) {
                    $constraint->test($testValue, $value);
                    $this->assert = $constraint->getAssert();
                }
                $this->reload[$value] = $testValue;
            }
        }

        if($constraints){
            foreach($constraints as $nameValue => $constraint) {
                if(isset($constraint["value"], $constraint["constraints"])){
                    foreach($constraint["constraints"] as $constrt) {
                        $constrt->test($constraint["value"], $nameValue);
                        $this->assert = $constrt->getAssert();
                    }
                    $this->reload[$value] = $constraint["value"];
                }
                else{
                    throw new FormException('The $asserts table of the assertion method is poorly implemented.');
                }
            }
        }

        if($recaptcha){
            $value = null;
            if(((new ReCaptcha)->test()) === false){
                $value = false;
            }
            else{
                $this->assert->that($value, "ReCAPTCHA")->tryAll()->null();
                $this->reload["ReCAPTCHA"] = $value;
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
            Reloader::getInstance()->add($this->reload);
            dump($e->getErrorExceptions());
            FlashBag::getInstance()->add("red", "Il y a eu une erreur dans la saisie de votre formulaire");
            return false;
        }
    }

}