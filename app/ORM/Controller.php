<?php

namespace Framework\ORM;

use Framework\Http\Response;
use Framework\Http\RedirectionResponse;
use Framework\Http\Request;
use Framework\Router\Router;
use Framework\ORM\Database;
use Project\PersonalExtendTwig\PersonalFunctions;
use Project\PersonalExtendTwig\PersonalFilters;
use Project\PersonalExtendTwig\PersonalGlobals;
use Framework\MessageFlash;

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
        return [$valid, $reponse];
    }
}