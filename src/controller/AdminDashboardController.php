<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class AdminDashboardController extends Controller
{
   /**
    * @param string $id
    * @return Response
    */
    public function show()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit("post", 10);
        $commentsReport = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findByParam(['report' => 1], "comment");
        //$comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAllWithLimitOffset("comment",);

        //$nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam("comment", ['post_id' => $billet->getId(), 'valid' => 1]);

        return $this->render("adminDashboard.html.twig", ['billets' => $billets, 'commentsReport' => $commentsReport, 'nbComments' => $nbComments]);
    }

}