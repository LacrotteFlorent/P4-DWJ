<?php

namespace Framework\ORM;

use Framework\Http\Response;
use Framework\Http\RedirectionResponse;
use Framework\Http\Request;
use Framework\Router\Router;

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
}