<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\Paginate;

class BlogController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit(5);
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => (array_values($billets)[0])->getId(), 'valid' => 1]);

        // Show comments by page
        if(count($billets)>$_ENV["PAGE_ARTICLES"]){
            if($_GET){
                if($_GET['page']){
                    $pages = new Paginate($_ENV["PAGE_ARTICLES"], (int) count($billets), $_GET['page']);
                }
                else{
                    throw new SrcControllerException('Une erreur est survenue lors de la soumission de votre commentaire');
                }
            }
            else{
                $pages = new Paginate($_ENV["PAGE_ARTICLES"], (int) count($billets), 1);
            }
            $billetsToShow = [];
            $i = 0;
            foreach(($pages->getShowElements()) as $element)
            {
                if(count($pages->getShowElements()) > $_ENV["PAGE_ARTICLES"]){
                    throw new SrcControllerException('Hop, hop, hop, ou allez vous ? Cette page n\'existe pas !');
                }
                array_push($billetsToShow, array_values($billets)[(array_values(($pages->getShowElements()))[$i])]);
                $i ++;
            }
        }
        else{
            $billetsToShow = $billets;
            $pages = null;
        }

        return $this->render("blog.html.twig", [
            'billetsToShow' => $billetsToShow,
            'billets'       => $billets,
            'nbComments'    => $nbComments,
            'pages'         => $pages
        ]);
    }

}
