<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\MessageFlash;
use Project\Model\BilletModel;

class AdminPostController extends Controller
{
   /**
    * @return Response
    */
    public function show($id)
    {   
        $erreurs = [];
        if($this->request->getRequestMethod() === 'POST'){
            if(($this->testForForm(["name", "alt", "title", "content", "datePost", "timePost"]))[0] === true){
                $this->post();
            }
            else{
                $erreurs = ($this->testForForm(["name", "alt", "title", "content", "datePost", "timePost"]))[1];
                $flashMessage = (MessageFlash::getInstance())->add("bg-danger", "OOPS, il y a eu une erreur dans la saisie du formulaire !");
            }
        }

        if($id === "0"){
            return $this->render("adminPost.html.twig");
        }

        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);

        return $this->render("adminPost.html.twig", [
            'billet'        => $billet,
            'erreurs'       => $erreurs
        ]);
    }

    /**
     * @return RedirectionResponse
     */
    public function post()
    {
        $dataFormImage = [];
        $dataFormImage["name"] =  $_POST["image"];
        $dataFormImage["alt"] =  $_POST["alt"];
        $this->getDatabase()->getManager('\Project\Model\BilletModel')->insertByModel((new ImageModel())->hydrateForSql($dataForm));

        $dataFormBillet = [];
        $dataFormBillet["title"] = addslashes($_POST["title"]);
        $dataFormBillet["content"] = addslashes($_POST["content"]);

        $dataFormBillet["image_id"] = $this->getDatabase()->getManager('\Project\Model\BilletModel')->idLastInsert();

        $date = new \Datetime;
        date_timezone_set($date, timezone_open('Europe/Paris'));
        $date = $date->format("Y-m-d H:i:s");
        $dataFormBillet["created_at"] = $date;

        $datePost = new \Datetime;
        date_timezone_set($datePost, timezone_open('Europe/Paris'));
        $datePost->setDate($_POST["datePost"]);
        $datePost->setTime($_POST["timePost"]);
        $datePost->format("Y-m-d H:i:s");
        $dataFormBillet["posted_at"] = $datePost;


        if(isset($_POST["draft"])){
            $dataFormBillet["draft"] = 1;
        }
        else{
            $dataFormBillet["draft"] = 0;
        }

        $dataFormBillet["like_count"] = 0;
        $dataFormBillet["view_count"] = 0;

        dump((new BilletModel())->hydrateForSql($dataFormBillet));
        
        $this->getDatabase()->getManager('\Project\Model\NewsletterModel')->insertByModel((new BilletModel())->hydrateForSql($dataFormBillet));

        $flashMessage = (MessageFlash::getInstance())->add("blue", "Vous venez de modifier un article !");

        return $this->redirection('/blog');
    }

}