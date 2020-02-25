<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class BilletController extends Controller
{
   /**
    * @param string $id
    * @return Response
    */
    public function show($id)
    {
        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id, "post");
        $comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findByParam(['post_id' => $id, 'valid' => 1], "comment");
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam("comment", ['post_id' => $billet->getId(), 'valid' => 1]);

        return $this->render("billet.html.twig", ['billet' => $billet, 'comments' => $comments, 'nbComments' => $nbComments]);
    }

}