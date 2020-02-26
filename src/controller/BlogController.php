<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class BlogController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit(5);
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => (array_values($billets)[0])->getId(), 'valid' => 1]);

        return $this->render("blog.html.twig", ['billets' => $billets, 'nbComments' => $nbComments]);
    }

}
