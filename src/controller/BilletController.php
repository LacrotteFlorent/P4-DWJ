<?php

namespace Project\Controller;

use Framework\Form\Validator;
use Framework\Controller;
use Framework\FlashBag;
use Framework\Paginator;
use Project\Model\CommentModel;


class BilletController extends Controller
{
   /**
    * @param string $id
    * @return Response
    */
    public function show($id)
    {
        if($this->request->getRequestMethod() === 'POST'){
            $commentModel = (new CommentModel())->hydrateForSql([
                "content"   => $_POST["content"],
                "posted_at" => date($_ENV["DATE_FORMAT"]),
                "valid"     => 0,
                "report"    => 0,
                "author"    => $_POST["author"],
                "post_id"   => $id
            ]);
        
            if((new Validator)->assertion($commentModel, null, true)){
                $this->getDatabase()->getManager('\Project\Model\CommentModel')->insertByModel($commentModel);
                (FlashBag::getInstance())->add("green", " Votre commentaire à bien été envoyé ! Il est maintenant en attente de validation.");
                return $this->redirection('/billet/' . $id);
            }
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

}