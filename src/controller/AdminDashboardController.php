<?php

namespace Project\Controller;

use Framework\Controller;
use Framework\Paginator;


class AdminDashboardController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam();
        $nbCommentsReport = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['report' => 1]);
        $nbCommentsWithoutReport = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['report' => 0]);
        $nbCommentsInvalid = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['valid' => 0]);
        $nbBillets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->countParam();

        $billetModelLikes = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findSelectByParam(["like_count"]);
        $billetModelView = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findSelectByParam(["view_count"]);

        $totalCountLikes = 0;
        foreach ($billetModelLikes as $billet){
            $totalCountLikes += $billet->getLikeCount();
        }

        $totalCountView = 0;
        foreach ($billetModelView  as $billet){
            $totalCountView += $billet->getViewCount();
        }

        $paginatorBillet = new Paginator($this->request, (int) $nbBillets['count'], $this->getDatabase()->getManager('\Project\Model\BilletModel'), "PAGE_DASHBOARD", "pageBillet");
        $paginatorComments = new Paginator($this->request, (int) $nbCommentsWithoutReport['count'], $this->getDatabase()->getManager('\Project\Model\CommentModel'), "PAGE_DASHBOARD", "pageCom", ['report' => 0]);
        $paginatorCommentsReport = new Paginator($this->request, (int) $nbCommentsReport['count'], $this->getDatabase()->getManager('\Project\Model\CommentModel'), "PAGE_DASHBOARD", "pagesCommentReport", ['report' => 1]);
        
        return $this->render("adminDashboard.html.twig", [
            'billets'           => $paginatorBillet,
            'commentsReport'    => $paginatorCommentsReport,
            'nbComments'        => $nbComments,
            'comments'          => $paginatorComments,
            'totalCountLikes'   => $totalCountLikes,
            'totalCountViews'   => $totalCountView,
            'totalCountReport'  => $nbCommentsReport,
            'totalCountToValid' => $nbCommentsInvalid
        ]);
    }

}