<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\MessageFlash;
use Project\Model\BilletModel;
use Project\Model\ImageModel;

class AdminPostController extends Controller
{
   /**
    * @return Response
    */
    public function show($id)
    {   
        //tests formulaire
        $erreurs = [];
        if($this->request->getRequestMethod() === 'POST'){
            if(($this->testForForm(["alt", "title", "content", "datePost", "timePost"]))[0] === true){
                //test fichier upload
                if(isset($_FILES)){
                    if ((($_FILES["imageToUpload"]["type"] == "image/gif")
                        || ($_FILES["imageToUpload"]["type"] == "image/jpeg")
                        || ($_FILES["imageToUpload"]["type"] == "image/pjpeg"))
                        && ($_FILES["imageToUpload"]["size"] < 300000)) // 3 Mo
                        {
                            if($_FILES["imageToUpload"]["error"] > 0){
                                $flashMessage = (MessageFlash::getInstance())->add("red", "OOPS, il y a eu une erreur dans le téléchargement de l'image !");
                            }
                            else{
                                if (file_exists("public/img/" . $_FILES["imageToUpload"]["name"]))
                                {
                                    $flashMessage = (MessageFlash::getInstance())->add("red", "OOPS, le fichier existe déja !");
                                }
                                else{
                                    $name = basename($_FILES["imageToUpload"]["name"]);
                                    move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], "public/img/" . $name);
                                    $this->post();
                                }                                
                            }
                        }
                    else{
                        $flashMessage = (MessageFlash::getInstance())->add("red", "OOPS, il y a eu une erreur, le fichier est invalide !");
                    }
                }
                else{
                    $flashMessage = (MessageFlash::getInstance())->add("red", "OOPS, il y a eu une erreur, lors de la soumission du formulaire !");
                }
            }
            else{
                $erreurs = ($this->testForForm(["alt", "title", "content", "datePost", "timePost"]))[1];
                $flashMessage = (MessageFlash::getInstance())->add("red", "OOPS, il y a eu une erreur dans la saisie du formulaire !");
            }
        }

        //messages
        $flashMessages = $this->flashMessages();

        // Si l'id est = 0 alors c'est un nouveau post
        if($id === "0"){
            return $this->render("adminPost.html.twig", [
                'erreurs'       => $erreurs,
                'flashMessages' => $flashMessages
            ]);
        }

        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);

        return $this->render("adminPost.html.twig", [
            'billet'        => $billet,
            'erreurs'       => $erreurs,
            'flashMessages' => $flashMessages
        ]);
    }

    /**
     * @return RedirectionResponse
     */
    public function post()
    {
        
        $dataFormImage = [];
        $dataFormImage["name"] =  $_FILES["imageToUpload"]["name"];
        $dataFormImage["alt"] =  $_POST["alt"];
        //$this->getDatabase()->getManager('\Project\Model\ImageModel')->insertByModel((new ImageModel())->hydrateForSql($dataFormImage));

        $dataFormBillet = [];
        $dataFormBillet["title"] = addslashes($_POST["title"]);
        $dataFormBillet["content"] = addslashes($_POST["content"]);

        $dataFormBillet["image_id"] = $this->getDatabase()->getManager('\Project\Model\ImageModel')->idLastInsert();

        $date = new \Datetime;
        date_timezone_set($date, timezone_open('Europe/Paris'));
        $date = $date->format("Y-m-d H:i:s");
        $dataFormBillet["created_at"] = $date;

        if($_POST["datePost"]){
            $datePost = new \Datetime;
            date_timezone_set($datePost, timezone_open('Europe/Paris'));
            $datePost->setDate($_POST["datePost"]);// ne peux pas recvoir un array
            $datePost->setTime($_POST["timePost"]);// ne peux pas recvoir un array
            $datePost->format("Y-m-d H:i:s");
            $dataFormBillet["posted_at"] = $datePost;
        }
        else{
            $datePost = new \Datetime;
            date_timezone_set($datePost, timezone_open('Europe/Paris'));
            $datePost = $datePost->format("Y-m-d H:i:s");
            $dataFormBillet["posted_at"] = $datePost;
        }

        if(isset($_POST["draft"])){
            $dataFormBillet["draft"] = 1;
        }
        else{
            $dataFormBillet["draft"] = 0;
        }

        $dataFormBillet["like_count"] = 0;
        $dataFormBillet["view_count"] = 0;

        //$this->getDatabase()->getManager('\Project\Model\BilletModel')->insertByModel((new BilletModel())->hydrateForSql($dataFormBillet));

        $flashMessage = (MessageFlash::getInstance())->add("blue", "Vous venez de modifier un article !");

        return $this->redirection('/blog');
    }

}