<?php

namespace Framework;

use Framework\PersonalExtendTwig\PersonalFunctions;
use Framework\PersonalExtendTwig\PersonalFilters;
use Framework\PersonalExtendTwig\PersonalGlobals;
use Framework\Http\RedirectionResponse;
use Framework\Http\Response;
use Framework\Router\Router;
use Framework\Http\Request;
use Framework\ORM\Database;
use Framework\FlashBag;

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
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../view');
        $this->twig = new \Twig\Environment($loader, array(
            'cache' => false    // le temps du développement on laisse le cache à false // __DIR__ . '/tmp'
        ));
        $this->twig->addExtension(new PersonalFunctions());
        $this->twig->addExtension(new PersonalFilters());
        $this->twig->addExtension(new PersonalGlobals());
    }

    /**
     * @param string $uri
     * @return RedirectionResponse
     */
    protected function redirection($uri): RedirectionResponse
    {
        return new RedirectionResponse($uri);
    }

    /**
     * @param string $filename
     * @param array $database
     * @return Response
     */
    protected function render($filename, $data = []): Response
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
     * @param string $userAccessGranted {'admin' or 'user'}
     * @internal
     *  $userAccessGranted
     *  Allows access to the page for admin OR admin and user
     * @return RedirectionResponse
     */
    protected function denyAccessUnlessGranted($userAccessGranted)
    {
        if(isset($_SESSION['login'])){
            $role = ($this->getDatabase()->getManager('\Project\Model\UserModel')->findSelectByParam('*', ['email' => $_SESSION["login"]]))[0]->getRole();
            if($userAccessGranted = "admin"){
                if($role === "ROLE_ADMIN"){
                    return true;
                }
            }
            elseif($userAccessGranted = "user"){
                if($role === "ROLE_ADMIN" || $role === "ROLE_USER"){
                    return true;
                }
            }
        }
        return false;
    }

}