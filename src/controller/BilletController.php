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
        $comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findByParam("post_id" ,$id, "comment");

        return $this->render("billet.html.twig", ['billet' => $billet, 'comments' => $comments]);
        
    }

}