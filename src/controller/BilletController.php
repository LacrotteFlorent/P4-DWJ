<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\Paginate;
use Framework\MessageFlash;
use Project\Controller\SrcControllerException;

class BilletController extends Controller
{
   /**
    * @param string $id
    * @return Response
    */
    public function show($id)
    {
        if($_POST){
            $this->post($id);
        }

        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
        $comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAllByParam(['post_id' => $id, 'valid' => 1]);
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => $billet->getId(), 'valid' => 1]);

        // Show comments by page
        if($nbComments['count']>$_ENV["PAGE_COMMENTS"]){
        if($_GET){
            if($_GET['pageCom']){
                $pages = new Paginate($_ENV["PAGE_COMMENTS"], (int) $nbComments['count'], $_GET['pageCom']);
            }
            else{
                throw new SrcControllerException('Une erreur est survenue lors de la soumission de votre commentaire');
            }
        }
        else{
            $pages = new Paginate($_ENV["PAGE_COMMENTS"], (int) $nbComments['count'], 1);
        }
        $commentToShow = [];
        $i = 0;
        foreach(($pages->getShowElements()) as $element)
        {
            if(count($pages->getShowElements()) > $_ENV["PAGE_COMMENTS"]){
                throw new SrcControllerException('Hop, hop, hop, ou allez vous ? Cette page n\'existe pas !');
            }
            array_push($commentToShow, array_values($comments)[(array_values(($pages->getShowElements()))[$i])]);
            $i ++;
        }
        }
        else{
            $commentToShow = $comments;
            $pages = null;
        }

        //messages
        $flashMessages = $this->flashMessages();

        return $this->render("billet.html.twig", [
            'billet'        => $billet,
            'comments'      => $commentToShow,
            'nbComments'    => $nbComments,
            'pages'         => $pages,
            'flashMessages' => $flashMessages
        ]);
    }

    /**
     * @param string $id
     * @return RedirectionResponse
     */
    private function post($id)
    {
        $dataForm = $_POST;
        $author = addslashes(array_shift($dataForm));
        $content = addslashes(array_shift($dataForm));
        
        $dataForm["content"] = $content;

        $date = new \Datetime;
        date_timezone_set($date, timezone_open('Europe/Paris'));
        $date = $date->format("Y-m-d H:i:s");
        $dataForm["posted_at"] = $date;

        $dataForm["valid"] = 1;
        $dataForm["report"] = 0;
        $dataForm["author"] = $author;
        $dataForm["post_id"] = $id;

        
        $dataForm = $this->getDatabase()->getManager('\Project\Model\CommentModel')->insertPrepare('comment', $dataForm);

        $flashMessage = (MessageFlash::getInstance())->add("bg-success", " Votre commentaire à bien été envoyé ! Il est maintenant en attente de validation.");

        $_POST = null;

        $this->redirection('/billet/' . $id);
    }

}