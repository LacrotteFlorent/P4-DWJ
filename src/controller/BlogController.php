<?php

namespace Project\Controller;

use Framework\Form\Validation\CheckboxConstraint;
use Framework\Form\Validation\Validator;
use Framework\Controller;
use Framework\FlashBag;
use Framework\Paginator;
use Project\Model\NewsletterModel;

class BlogController extends Controller
{
    
   /**
    * @return Response|RedirectionResponse
    */
    public function show()
    {
        if($this->request->getRequestMethod() === 'POST'){
            $newsletterModel = (new NewsletterModel())->hydrateForSql([
                "full_name" => $_POST["firstName"] .' : '. $_POST["lastName"],
                "email"     => $_POST["mail"],
                "signed_at" => date($_ENV["DATE_FORMAT"])
            ]);
        
            if((new Validator)->assertion($newsletterModel, [
                'rgpd'      => [
                    'value'         => $_POST["acceptRGPD"],
                    "constraints"   => [new CheckboxConstraint()]
                ]
                ], true)){
                FlashBag::getInstance()->add("blue", "Vous êtes maintenant inscrit à la newsletter !");
                $this->getDatabase()->getManager('\Project\Model\NewsletterModel')->insertByModel($newsletterModel);
                return $this->redirection('/blog');
            }
        }

        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit(null, ["draft" => '= 0', "posted_at" => date($_ENV["DATE_FORMAT"])], '<=');
        foreach($billets as $billet){
            $imageBillets[$billet->getId()] = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($billet->getImageId(), "image");
        }
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => (array_values($billets)[0])->getId(), 'valid' => 1]);
        $nbBillets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->countParam(["draft" => 0, "posted_at" => date($_ENV["DATE_FORMAT"])], null, '<=');
        $paginator = new Paginator($this->request, (int) $nbBillets['count'], $this->getDatabase()->getManager('\Project\Model\BilletModel'), "PAGE_ARTICLES", "page", ["draft" => 0, "posted_at" => date($_ENV["DATE_FORMAT"])], "posted_at", false, '<=');
        return $this->render("blog.html.twig", [
            'billetsToShow' => $paginator,
            'billets'       => $billets,
            'images'        => $imageBillets,
            'nbComments'    => $nbComments
        ]);
    }

}
