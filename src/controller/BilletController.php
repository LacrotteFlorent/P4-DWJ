<?php

namespace Project\Controller;

use Framework\Controller;
use Framework\FlashBag;
use Framework\Paginator;


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
        $imageBillet = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($billet->getImageId(), "image");
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => $billet->getId(), 'valid' => 1]);

        $paginator = new Paginator($this->request, (int) $nbComments['count'], $this->getDatabase()->getManager('\Project\Model\CommentModel'), "PAGE_COMMENTS", "pageCom", ['post_id' => $id, 'valid' => 1]);

        return $this->render("billet.html.twig", [
            'billet'        => $billet,
            'image'         => $imageBillet,
            'nbComments'    => $nbComments,
            'pages'         => $paginator,
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

        $flashMessage = (FlashBag::getInstance())->add("green", " Votre commentaire à bien été envoyé ! Il est maintenant en attente de validation.");

        $_POST = null;

        $this->redirection('/billet/' . $id);
    }

}