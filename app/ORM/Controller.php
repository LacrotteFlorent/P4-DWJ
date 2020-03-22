<?php

namespace Framework\ORM;

use \Assert\Assertion;
use Framework\Http\RedirectionResponse;
use Framework\Http\Response;
use Framework\Router\Router;
use Framework\Http\Request;
use Framework\ORM\Database;
use Framework\FlashBag;
use Project\PersonalExtendTwig\PersonalFunctions;
use Project\PersonalExtendTwig\PersonalFilters;
use Project\PersonalExtendTwig\PersonalGlobals;

class Controller
{
     /**
     * @var Request
     */
    protected $request;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var Database
     */
    private $database;

    /**
     * BlogController constructor.
     * @param Request $request
     * @param Router $router
     */
    public function __construct(Request $request, Router $router)
    {
        $this->request = $request;
        $this->router = $router;
        $this->database = Database::getInstance($request);
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../../view');
        $this->twig = new \Twig\Environment($loader, array(
            'cache' => false    // le temps du développement on laisse le cache à false // __DIR__ . '/tmp'
        ));
        $this->twig->addExtension(new PersonalFunctions($this->getDatabase()));
        $this->twig->addExtension(new PersonalFilters());
        $this->twig->addExtension(new PersonalGlobals());
    }

    /**
     * @param array $paramsMatches
     * @return Response
     */
    public function index($paramsMatches): Response
    {
        return new Response("<h1>Reponse</h1>");
    }

    /**
     * @param string $uri
     * @return RedirectionResponse
     */
    public function redirection($uri): RedirectionResponse
    {
        return new RedirectionResponse($uri);
    }

    /**
     * @param string $filename
     * @param array $database
     * @return Response
     */
    public function render($filename, $data = []): Response
    {
        $view = $this->twig->load($filename);
        $content = $view->render($data);
        return new Response($content);
    }

    /**
     * @return Database
     */
    protected function getDatabase()
    {
        return $this->database;
    }

    /**
     * @param array $varToBeCheck
     * @return array
     */
    protected function testForForm($varToBeCheck)
    {
        $reponse = [];
        $valid = true;
        foreach($varToBeCheck as $var){
            if(isset($this->request->getPost()[$var])){
                $reponse[$var] = $this->request->getPost()[$var];

                switch($var){
                    case 'mail':
                        if (filter_var($this->request->getPost()[$var], FILTER_VALIDATE_EMAIL)) {
                            $reponse[$var] = $this->request->getPost()[$var];
                        } else {
                            $reponse[$var] = "Le mail que vous avez saisi n'est pas valide";
                            $valid = false;
                        }
                        break;
                    case 'acceptRGPD':
                        if($this->request->getPost()[$var] === "on"){
                            $reponse[$var] = $this->request->getPost()[$var];
                        }
                        else{
                            $reponse[$var] = "Vous n'avez pas coché la case d'acceptation RGPD";
                            $valid = false;
                        }
                        break;
                    case 'message':
                        if(strlen($var) < 255){
                            $reponse[$var] = $this->request->getPost()[$var];
                        }
                        else{
                            $reponse[$var] = "Le message que vous avez saisi est trop long";
                            $valid = false;
                        }
                        break;
                }
            }
            else{
                $reponse[$var] = "Ce champ doit être renseigné";
                $valid = false;
            }
        }

        if(!$valid){
            $flashMessage = (FlashBag::getInstance())->add("red", "OOPS, il y a eu une erreur dans la saisie du formulaire !");
        }

        return [$valid, $reponse];
    }

    /**
     * @param array $model
     * @return bool $valid
     */
    protected function assertion($model)
    {
        foreach($model->metadata()["columns"] as $value => $column) {
            $testValue = $model->{sprintf("get%s", $column["property"])}();
            $testValueString = (string) 'salut';
            $testValueInteger = 3;
            $testValueMail = 'bralocaz@gmail.com';
            switch ($column["assert"]) {
                case 'integer':
                    try {
                        Assertion::integer($testValue, "Cette information dois être un entier");
                    } catch(AssertionFailedException $e) {
                        $e->getValue(); // the value that caused the failure
                        $e->getConstraints(); // the additional constraints of the assertion.
                        $flashMessage = (FlashBag::getInstance())->add("red", $e);
                    }
                    break;
                case 'string':
                    try {
                        Assertion::string($testValue, "Cette information dois être une chaîne de caractère");
                    } catch(AssertionFailedException $e) {
                        $e->getValue(); // the value that caused the failure
                        $e->getConstraints(); // the additional constraints of the assertion.
                        $flashMessage = (FlashBag::getInstance())->add("red", $e);
                    }
                    break;
                case 'email':
                    try {
                        Assertion::email($testValue, "Cette information dois être un email");
                    } catch(AssertionFailedException $e) {
                        $e->getValue(); // the value that caused the failure
                        $e->getConstraints(); // the additional constraints of the assertion.
                        $flashMessage = (FlashBag::getInstance())->add("red", $e);
                    }
                    break;
                case 'null':
                    try {
                        Assertion::integer($testValue, "Cette information dois être nulle");
                    } catch(AssertionFailedException $e) {
                        $e->getValue(); // the value that caused the failure
                        $e->getConstraints(); // the additional constraints of the assertion.
                        $flashMessage = (FlashBag::getInstance())->add("red", $e);
                    }
                    break;
                case 'integerOrNull':
                    if($testValue != null){
                        try {
                            Assertion::integer($testValue, "Cette information dois être un entier");
                        } catch(AssertionFailedException $e) {
                            $e->getValue(); // the value that caused the failure
                            $e->getConstraints(); // the additional constraints of the assertion.
                            $flashMessage = (FlashBag::getInstance())->add("red", $e);
                        }
                    }
                    else{
                        try {
                            Assertion::null($testValue, "Cette information dois être nulle");
                        } catch(AssertionFailedException $e) {
                            $e->getValue(); // the value that caused the failure
                            $e->getConstraints(); // the additional constraints of the assertion.
                            $flashMessage = (FlashBag::getInstance())->add("red", $e);
                        }
                    }
                    break;
                case 'date':
                    try {
                        Assertion::date($testValue, $_ENV["DATE_FORMAT"], "Cette information dois être une date et au bon format");
                    } catch(AssertionFailedException $e) {
                        $e->getValue(); // the value that caused the failure
                        $e->getConstraints(); // the additional constraints of the assertion.
                        $flashMessage = (FlashBag::getInstance())->add("red", $e);
                    }
                    break;
                case 'fichier':
                    try {
                        Assertion::fichier($testValue, "Ce fichier n'est pas valide");
                    } catch(AssertionFailedException $e) {
                        $e->getValue(); // the value that caused the failure
                        $e->getConstraints(); // the additional constraints of the assertion.
                        $flashMessage = (FlashBag::getInstance())->add("red", $e);
                    }
                    break;
                default:
                    throw new ORMException ("Ce type de variable n'est pas pris en compte");
                    break;
            }
        }
    }
}