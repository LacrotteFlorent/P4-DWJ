<?php

namespace Framework\ORM;

use Framework\Http\Response;
use Framework\Http\RedirectionResponse;
use Framework\Http\Request;
use Framework\Router\Router;
use Framework\ORM\Database;

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
    private $twig;

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
            'cache' => false
        ));
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
     * @param array $paramsMatches
     * @return RedirectionResponse
     */
    public function redirection($paramsMatches): RedirectionResponse
    {
        return new RedirectionResponse($this->request->getRequestUri());
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
        dump($this->database);
        return $this->database;
    }

}