<?php

namespace Project\Controller;

use Framework\Form\Validation\CheckboxConstraint;
use Framework\Form\Validation\NotBlankConstraint;
use Framework\Form\Validation\StringConstraint;
use Framework\Form\Validation\Validator;
use Framework\Controller;
use Project\Model\NewsletterModel;

class SearchBlogController extends Controller
{

    /**
     * @return Response
     */
    public function search()
    {
        if($this->request->getRequestMethod() === 'POST'){
            if((new Validator)->assertion(null, [
                'search'    => [
                    "value"         => $this->request->getPost()["keyWord"],
                    "constraints"   => [new StringConstraint(), new NotBlankConstraint()]
                ]
                ], true)){

                $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit(null, ["draft" => '= 0', "posted_at" => date($_ENV["DATE_FORMAT"])], '<=');
                foreach($billets as $billet){
                    $imageBillets[$billet->getId()] = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($billet->getImageId(), "image");
                }
                $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => (array_values($billets)[0])->getId(), 'valid' => 1]);
                $nbBillets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->countParam(["draft" => 0, "posted_at" => date($_ENV["DATE_FORMAT"])], null, '<=');
                $resultSearch = $this->getDatabase()->getManager('\Project\Model\BilletModel')->search($this->request->getPost()["keyWord"]);
                return $this->render("searchBlog.html.twig", [
                    'billetsToShow' => $resultSearch,
                    'billets'       => $billets,
                    'images'        => $imageBillets,
                    'nbComments'    => $nbComments,
                    'search'        => $this->request->getPost()["keyWord"],
                ]);
            }
            else{
                return $this->redirection('/blog');
            }
        }
    }

}