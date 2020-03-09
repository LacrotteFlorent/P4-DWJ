<?php

namespace Framework\ORM;

use Framework\Http\Response;
use Framework\Http\RedirectionResponse;
use Framework\Http\Request;
use Framework\Router\Router;
use Framework\ORM\Database;
use Project\PersonalExtendTwig\PersonalFunctions;
use Project\PersonalExtendTwig\PersonalFilters;
use Framework\MessageFlash;

class Controller
{
     /**
     * @var Request
     */
    private $request;

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
     * @return array
     */
    protected function flashMessages()
    {
        if(isset($_SESSION["FLASH_MESSAGES"]))
        {
            $flashMessages = ($_SESSION["FLASH_MESSAGES"])->getMessages();
            return $flashMessages;
        }

    }

    /**
     * @param array $varToBeCheck
     */
    protected function testForForm($varToBeCheck)
    {
        foreach($varToBeCheck as $var){
            if(null === !($this->request->getRequest($var))){
                return false;
            }
        }
         return true;
    }
    
}