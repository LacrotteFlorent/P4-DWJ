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
        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
        $comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAllByParam(['post_id' => $id, 'valid' => 1]);
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => $billet->getId(), 'valid' => 1]);

        $test = $this->getDatabase()->getManager('\Project\Model\CommentModel')->insert('comment', [
            'content'       =>  'ceci est une phrase de test',
            'posted_at'     =>  '2020-01-01 08:15:10',
            'valid'         =>  1,
            'report'        =>  0,
            'author'        => 'Guesttt',
            'post_id'       => 1,
            'user_id'       => 234
            ]);
        return $this->render("billet.html.twig", ['billet' => $billet, 'comments' => $comments, 'nbComments' => $nbComments]);
    }

}