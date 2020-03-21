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
        $erreurs = [];
        if($this->request->getRequestMethod() === 'POST'){
            $test = ($this->testForForm(["firstName", "lastName", "mail", "acceptRGPD"]));
            if($test[0]){
                $this->post();
            }
            else{
                $erreurs = $test[1];
            }
        }

        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit();
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => (array_values($billets)[0])->getId(), 'valid' => 1]);
        $nbBillets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->countParam();

        $paginator = new Paginator($this->request, (int) $nbBillets['count'], $this->getDatabase()->getManager('\Project\Model\BilletModel'), "PAGE_ARTICLES", "page", null, "posted_at", true);

        return $this->render("blog.html.twig", [
            'billetsToShow' => $paginator,
            'billets'       => $billets,
            'nbComments'    => $nbComments,
            'erreurs'       => $erreurs
        ]);
    }

    /**
     * @return RedirectionResponse
     */
    public function post()
    {
        $dataForm = [];
        $dataForm["full_name"] = (addslashes($_POST["firstName"]) .' : '. addslashes($_POST["lastName"]));
        $dataForm["email"] = $_POST["mail"];

        $date = new \Datetime;
        date_timezone_set($date, timezone_open('Europe/Paris'));
        $date = $date->format("Y-m-d H:i:s");
        $dataForm["signed_at"] = $date;

        if(isset($userId)){
            $dataForm["user_id"] = $userId;
        }
        
        $this->getDatabase()->getManager('\Project\Model\NewsletterModel')->insertByModel((new NewsletterModel())->hydrateForSql($dataForm));

        $flashMessage = (FlashBag::getInstance())->add("blue", "Vous êtes maintenant inscrit à la newsletter !");

        return $this->redirection('/blog');
    }

}
