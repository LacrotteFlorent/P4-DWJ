<?php

namespace Project\Controller;

use Framework\Form\Validation\StringConstraint;
use Framework\Form\Validation\SameConstraint;
use Framework\Form\Validation\Validator;
use Framework\Controller;
use Framework\Paginator;
use Framework\FlashBag;
use Project\Model\CommentModel;
use Project\Model\BilletModel;


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
                "content"   => $this->request->getPost()["content"],
                "posted_at" => date($_ENV["DATE_FORMAT"]),
                "valid"     => 0,
                "report"    => 0,
                "author"    => $this->request->getPost()["author"],
                "post_id"   => $id
            ]);
        
            if((new Validator)->assertion($commentModel, [
                'submit'    => [
                    'value'         => $this->request->getPost()["submit"],
                    "constraints"   => [new StringConstraint(), new SameConstraint('sent')]
                ]], true)){
                $this->getDatabase()->getManager('\Project\Model\CommentModel')->insertByModel($commentModel);
                (FlashBag::getInstance())->add("green", " Votre commentaire à bien été envoyé ! Il est maintenant en attente de validation.");
                return $this->redirection('/billet/' . $id);
            }
        }

        $this->getDatabase()->getManager('\Project\Model\BilletModel')->updateView($id); // adds 1 to the number of views of the post 
        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
        $imageBillet = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($billet->getImageId(), "image");
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => $billet->getId(), 'valid' => 1]);

        $paginator = new Paginator($this->request, (int) $nbComments['count'], $this->getDatabase()->getManager('\Project\Model\CommentModel'), "PAGE_COMMENTS", "pageCom", ['post_id' => $id, 'valid' => 1], "posted_at", true);

        return $this->render("billet.html.twig", [
            'billet'        => $billet,
            'image'         => $imageBillet,
            'nbComments'    => $nbComments,
            'pages'         => $paginator,
        ]);
    }

    /**
     * @param int | string $id
     * @return RedirectionResponse
     */
    public function like($id)
    {
        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
        $likes = $billet->getLikeCount();
        if($this->request->getRequestMethod() === 'POST'){
            $billetModel = (new BilletModel())->hydrateForSql([
                "like_count"   => ($billet->getLikeCount())+1,
            ]);
            $this->getDatabase()->getManager('\Project\Model\BilletModel')->update($billetModel, ["id"=>$id]);
            $_SESSION['like'] = $id;
            (FlashBag::getInstance())->add("blue", "Vous avez aimé le billet !");
            return $this->redirection('/billet/'. $id);
        }
        return $this->redirection('/blog');
    }

}