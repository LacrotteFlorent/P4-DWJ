<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\MessageFlash;
use Framework\Paging;


class BilletController extends Controller
{
   /**
    * @param string $id
    * @return Response
    */
    public function show($id)
    {
        if($this->request->getRequestMethod() === 'POST'){
            $this->post($id);
        }

        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
        $comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAllByParam(['post_id' => $id, 'valid' => 1]);
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => $billet->getId(), 'valid' => 1]);

        // pagging
        $paging = new Paging($this->request, (int) $nbComments['count'], $this->getDatabase()->getManager('\Project\Model\CommentModel'), ['post_id' => $id, 'valid' => 1]);
        dump($paging);

        //messages
        $flashMessages = $this->flashMessages();

        return $this->render("billet.html.twig", [
            'billet'        => $billet,
            'nbComments'    => $nbComments,
            'pages'         => $paging,
            'flashMessages' => $flashMessages
        ]);
    }

    /**
     * @param string $id
     * @return RedirectionResponse
     */
    private function post($id)
    {
            // insert in MYSQL
        $dataForm = [];
        $dataForm["content"] = addslashes($_POST["content"]);

        $date = new \Datetime;
        date_timezone_set($date, timezone_open('Europe/Paris'));
        $date = $date->format("Y-m-d H:i:s");
        $dataForm["posted_at"] = $date;

        $dataForm["valid"] = 1;
        $dataForm["report"] = 0;
        $dataForm["author"] = addslashes($_POST["author"]);
        $dataForm["post_id"] = $id;
        
        $dataForm = $this->getDatabase()->getManager('\Project\Model\CommentModel')->insertPrepare('comment', $dataForm);

        $flashMessage = (MessageFlash::getInstance())->add("green", " Votre commentaire à bien été envoyé ! Il est maintenant en attente de validation.");

        $_POST = null;

        $this->redirection('/billet/' . $id);
    }

}