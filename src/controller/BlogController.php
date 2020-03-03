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

        $flashMessage =(MessageFlash::getInstance())->add("bg-success", " Votre message à bien été envoyé !");
        //dump(MessageFlash::getInstance());
        //dump($_SESSION);
        //dump($_SESSION["FLASH_MESSAGES"]);
        //dump(($_SESSION["FLASH_MESSAGES"])->getMessage());
        dump($_SESSION["FLASH_MESSAGES"]);
        return $this->render("blog.html.twig", ['billets' => $billets, 'nbComments' => $nbComments]);
    }

}
