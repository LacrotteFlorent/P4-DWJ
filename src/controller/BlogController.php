<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\MessageFlash;
use Framework\Paginate;
use Project\Model\NewsletterModel;

class BlogController extends Controller
{
   /**
    * @return Response
    */
    public function show($final = 0)
    {
        $erreurs = [];
        if($this->request->getRequestMethod() === 'POST'){
            if(($this->testForForm(["firstName", "lastName", "mail", "acceptRGPD"]))[0] === true){
                $this->post();
            }
            else{
                $erreurs = ($this->testForForm(["firstName", "lastName", "mail", "acceptRGPD"]))[1];
                $flashMessage = (MessageFlash::getInstance())->add("bg-danger", "OOPS, il y a eu une erreur dans la saisie du formulaire !");
            }
        }

        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit(5);
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => (array_values($billets)[0])->getId(), 'valid' => 1]);

        // Show comments by page
        if(count($billets)>$_ENV["PAGE_ARTICLES"]){
            if(isset($this->request->getQuery()['page'])){
                $pages = new Paginate($_ENV["PAGE_ARTICLES"], (int) count($billets), $_GET['page']);
            }
            else{
                $pages = new Paginate($_ENV["PAGE_ARTICLES"], (int) count($billets), 1);
            }
            $billetsToShow = [];
            $i = 0;
            foreach(($pages->getShowElements()) as $element)
            {
                if(count($pages->getShowElements()) > $_ENV["PAGE_ARTICLES"]){
                    throw new SrcControllerException('Hop, hop, hop, ou allez vous ? Cette page n\'existe pas !');
                }
                array_push($billetsToShow, array_values($billets)[(array_values(($pages->getShowElements()))[$i])]);
                $i ++;
            }
        }
        else{
            $billetsToShow = $billets;
            $pages = null;
        }

        $flashMessages = $this->flashMessages();

        return $this->render("blog.html.twig", [
            'billetsToShow' => $billetsToShow,
            'billets'       => $billets,
            'nbComments'    => $nbComments,
            'flashMessages' => $flashMessages,
            'pages'         => $pages,
            'erreurs'       => $erreurs
        ]);
    }

    /**
     * @return RedirectionResponse
     */
    public function post()
    {
        $dataForm = [];
        $dataForm["full_name"] = (addslashes($_POST["firstName"]) .' : '. addslashes($_POST["lastName"]));
        $dataForm["email"] = $_POST["mail"];

        $date = new \Datetime;
        date_timezone_set($date, timezone_open('Europe/Paris'));
        $date = $date->format("Y-m-d H:i:s");
        $dataForm["signed_at"] = $date;

        if(isset($userId)){
            $dataForm["user_id"] = $userId;
        }
        
        $this->getDatabase()->getManager('\Project\Model\NewsletterModel')->insertByModel((new NewsletterModel())->hydrateForSql($dataForm));

        $flashMessage = (MessageFlash::getInstance())->add("blue", "Vous êtes maintenant inscrit à la newsletter !");

        return $this->redirection('/blog');
    }

}
