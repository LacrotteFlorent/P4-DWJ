<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\MessageFlash;
use Framework\Paginate;

class BlogController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        
        if($_POST){
            if($this->testForForm(["name", "lastName", "mail", "signed_at", "acceptRGPD" ])){
                return $this->post();
            }

            $flashMessage = (MessageFlash::getInstance())->add("bg-danger", "Vous avez mal renseigné le formulaire !");
        }

        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit(5);
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => (array_values($billets)[0])->getId(), 'valid' => 1]);

        // Show comments by page
        if(count($billets)>$_ENV["PAGE_ARTICLES"]){
            if($_GET){
                if($_GET['page']){
                    $pages = new Paginate($_ENV["PAGE_ARTICLES"], (int) count($billets), $_GET['page']);
                }
                else{
                    throw new SrcControllerException('Une erreur est survenue lors de la soumission de votre commentaire');
                }
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
            'pages'         => $pages
        ]);
    }

    /**
     * @return RedirectionResponse
     */
    private function post()
    {
        $dataForm = [];
        $dataForm["full_name"] = (addslashes($_POST["name"]) .' : '. addslashes($_POST["lastName"]));
        $dataForm["email"] = $_POST["mail"];

        $date = new \Datetime;
        date_timezone_set($date, timezone_open('Europe/Paris'));
        $date = $date->format("Y-m-d H:i:s");
        $dataForm["signed_at"] = $date;

        if(isset($userId)){
            $dataForm["user_id"] = $userId;
        }

        $dataForm = $this->getDatabase()->getManager('\Project\Model\NewsletterModel')->insertPrepare('newsletter', $dataForm);

        $flashMessage = (MessageFlash::getInstance())->add("bg-success", "Vous êtes maintenant inscrit à la newsletter !");

        $_POST = null;

        return $this->redirection('/blog');
    }

}
