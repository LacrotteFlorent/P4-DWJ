<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\FlashBag;
use Framework\Paginator;
use Project\Model\NewsletterModel;

class BlogController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        if($this->request->getRequestMethod() === 'POST'){
            $this->post();
        }

        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit();
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => (array_values($billets)[0])->getId(), 'valid' => 1]);
        $nbBillets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->countParam();

        $paginator = new Paginator($this->request, (int) $nbBillets['count'], $this->getDatabase()->getManager('\Project\Model\BilletModel'), "PAGE_ARTICLES", "page", null, "posted_at", true);

        return $this->render("blog.html.twig", [
            'billetsToShow' => $paginator,
            'billets'       => $billets,
            'nbComments'    => $nbComments,
            //'erreurs'       => $erreurs  TODO // CREATION D'UNE VARIABLE GLOBALE TWIG AVEC LES ERREURS FORMULAIRES
        ]);
    }

    /**
     * @return RedirectionResponse
     */
    public function post()
    {
        $dataForm = [];
        $dataForm["full_name"] = ($_POST["firstName"] .' : '. $_POST["lastName"]);
        $dataForm["email"] = $_POST["mail"];

        $date = new \Datetime;
        date_timezone_set($date, timezone_open('Europe/Paris'));
        $date = $date->format($_ENV["DATE_FORMAT"]);
        $dataForm["signed_at"] = $date;

        if(isset($userId)){
            $dataForm["user_id"] = $userId;
        }
        
        $newsletterModel = (new NewsletterModel())->hydrateForSql($dataForm);

        if($this->assertion($newsletterModel)){
            //$this->getDatabase()->getManager('\Project\Model\NewsletterModel')->insertByModel($newsletterModel);
            $flashMessage = (FlashBag::getInstance())->add("blue", "Vous êtes maintenant inscrit à la newsletter !");
        }

        return $this->redirection('/blog');
    }

}
