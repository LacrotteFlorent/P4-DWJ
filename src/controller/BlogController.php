<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\MessageFlash;

class BlogController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit(5);
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => (array_values($billets)[0])->getId(), 'valid' => 1]);

        $flashMessage = (MessageFlash::getInstance())->add("bg-success", " Votre message à bien été envoyé !");
        $flashMessage = (MessageFlash::getInstance())->add("bg-danger", " Votre message à bien été envoyé !");

        $flashMessages = $this->flashMessages();

        return $this->render("blog.html.twig", ['billets' => $billets, 'nbComments' => $nbComments, 'flashMessages' => $flashMessages]);
    }

}
