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
        if(count($billets)>$_ENV["PAGE_ARTICLES"]){
            if($_GET){
                if($_GET['pageBillet']){
                    $pagesBillet = new Paginate($_ENV["PAGE_ARTICLES"], (int) count($billets), $_GET['pageBillet']);
                }
                else{
                    throw new SrcControllerException('Une erreur est survenue lors de la soumission de votre commentaire');
                }
            }
            else{
                $pagesBillet = new Paginate($_ENV["PAGE_ARTICLES"], (int) count($billets), 1);
            }
            $billetsToShow = [];
            $i = 0;
            foreach(($pagesBillet->getShowElements()) as $element)
            {
                if(count($pagesBillet->getShowElements()) > $_ENV["PAGE_ARTICLES"]){
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
        if(count($commentsReport)>$_ENV["PAGE_ARTICLES"]){
            if($_GET){
                if($_GET['pagesCommentReport']){
                    $pagesCommentReport = new Paginate($_ENV["PAGE_ARTICLES"], (int) count($commentsReport), $_GET['pagesCommentReport']);
                }
                else{
                    throw new SrcControllerException('Une erreur est survenue lors de la soumission de votre commentaire');
                }
            }
            else{
                $pagesCommentReport = new Paginate($_ENV["PAGE_ARTICLES"], (int) count($commentsReport), 1);
            }
            $commentsReportToShow = [];
            $i = 0;
            foreach(($pagesCommentReport->getShowElements()) as $element)
            {
                if(count($pagesCommentReport->getShowElements()) > $_ENV["PAGE_ARTICLES"]){
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

        return $this->render("adminDashboard.html.twig", [
            'billets'           => $billetsToShow,
            'pagesBillet'       => $pagesBillet,
            'commentsReport'    => $commentsReportToShow,
            'pagesCommentReport'=> $pagesCommentReport,
            'nbComments'        => $nbComments,
            'totalCountLikes'   => $totalCountLikes,
            'totalCountViews'   => $totalCountView,
            'totalCountReport'  => $totalCountReport,
            'totalCountToValid' => $totalCountToValid
        ]);
    }

}