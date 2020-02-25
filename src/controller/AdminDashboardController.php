<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class AdminDashboardController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit("post", 10);
        $commentsReport = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAllByParam(['report' => 1], "comment");
        $commentsToValid = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAllByParam(['valid' => 0], "comment");
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam("comment");

        $totalCountLikes = 0;
        foreach ($billets as $billet){
            $totalCountLikes += $billet->getLikeCount();
        }
        // faire un filtre en pouvant préciser le parametre a GET

        $totalCountView = 0;
        foreach ($billets as $billet){
            $totalCountView += $billet->getViewCount();
        }
        // faire un filtre en pouvant préciser le parametre a GET

        $totalCountReport = 0;
        foreach ($commentsReport as $commentReport){
            $totalCountReport ++;
        }
        // faire un filtre en pouvant préciser le parametre a GET

        $totalCountToValid = 0;
        foreach ($commentsToValid as $commentToValid){
            $totalCountToValid ++;
        }

        //$billetsView = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findSelectByParam('post', ['view_count']);
        //$totalCountLikes = 0;
        //foreach ($billetsLikes as $billetLikes){
        //    $totalCountLikes += $billetLikes->getLikeCount();
        //}

        return $this->render("adminDashboard.html.twig", [
            'billets'           => $billets,
            'commentsReport'    => $commentsReport,
            'nbComments'        => $nbComments,
            'totalCountLikes'   => $totalCountLikes,
            'totalCountViews'   => $totalCountView,
            'totalCountReport'  => $totalCountReport,
            'totalCountToValid' => $totalCountToValid
            ]);
    }

}