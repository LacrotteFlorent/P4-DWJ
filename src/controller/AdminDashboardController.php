<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\Paginate;


class AdminDashboardController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit(10);
        $commentsReport = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAllByParam(['report' => 1]);
        $commentsToValid = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAllByParam(['valid' => 0]);
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam();
        $comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAllByParam([]);

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

        // paginate billet
        if(count($billets)>$_ENV["PAGE_DASHBOARD"]){
            if(isset($_GET['pageBillet'])){
                $pagesBillet = new Paginate($_ENV["PAGE_DASHBOARD"], (int) count($billets), $_GET['pageBillet']);
            }
            else{
                $pagesBillet = new Paginate($_ENV["PAGE_DASHBOARD"], (int) count($billets), 1);
            }
            $billetsToShow = [];
            $i = 0;
            foreach(($pagesBillet->getShowElements()) as $element)
            {
                if(count($pagesBillet->getShowElements()) > $_ENV["PAGE_DASHBOARD"]){
                    throw new SrcControllerException('Hop, hop, hop, ou allez vous ? Cette page n\'existe pas !');
                }
                array_push($billetsToShow, array_values($billets)[(array_values(($pagesBillet->getShowElements()))[$i])]);
                $i ++;
            }
        }
        else{
            $billetsToShow = $billets;
            $pagesBillet = null;
        }

        // paginate commentReport
        if(count($commentsReport)>$_ENV["PAGE_DASHBOARD"]){
            if(isset($_GET['pagesCommentReport'])){
                $pagesCommentReport = new Paginate($_ENV["PAGE_DASHBOARD"], (int) count($commentsReport), $_GET['pagesCommentReport']);
            }
            else{
                $pagesCommentReport = new Paginate($_ENV["PAGE_DASHBOARD"], (int) count($commentsReport), 1);
            }
            $commentsReportToShow = [];
            $i = 0;
            foreach(($pagesCommentReport->getShowElements()) as $element)
            {
                if(count($pagesCommentReport->getShowElements()) > $_ENV["PAGE_DASHBOARD"]){
                    throw new SrcControllerException('Hop, hop, hop, ou allez vous ? Cette page n\'existe pas !');
                }
                array_push($commentsReportToShow, array_values($commentsReport)[(array_values(($pagesCommentReport->getShowElements()))[$i])]);
                $i ++;
            }
        }
        else{
            $commentsReportToShow = $commentsReport;
            $pagesCommentReport = null;
        }

        // paginate commentReport
        if(count($comments)>$_ENV["PAGE_DASHBOARD"]){
            if(isset($_GET['pagesComment'])){
                $pagesComment = new Paginate($_ENV["PAGE_DASHBOARD"], (int) count($comments), $_GET['pagesComment']);
            }
            else{
                $pagesComment = new Paginate($_ENV["PAGE_DASHBOARD"], (int) count($comments), 1);
            }
            $commentsToShow = [];
            $i = 0;
            foreach(($pagesComment->getShowElements()) as $element)
            {
                if(count($pagesComment->getShowElements()) > $_ENV["PAGE_DASHBOARD"]){
                    throw new SrcControllerException('Hop, hop, hop, ou allez vous ? Cette page n\'existe pas !');
                }
                array_push($commentsToShow, array_values($comments)[(array_values(($pagesComment->getShowElements()))[$i])]);
                $i ++;
            }
        }
        else{
            $commentsToShow = $comments;
            $pagesComment = null;
        }

        return $this->render("adminDashboard.html.twig", [
            'billets'           => $billetsToShow,
            'pagesBillet'       => $pagesBillet,
            'commentsReport'    => $commentsReportToShow,
            'pagesCommentReport'=> $pagesCommentReport,
            'nbComments'        => $nbComments,
            'comments'          => $commentsToShow,
            'pagesComment'      => $pagesComment,
            'totalCountLikes'   => $totalCountLikes,
            'totalCountViews'   => $totalCountView,
            'totalCountReport'  => $totalCountReport,
            'totalCountToValid' => $totalCountToValid
        ]);
    }

}