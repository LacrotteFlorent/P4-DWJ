<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\Paginate;

class BilletController extends Controller
{
   /**
    * @param string $id
    * @return Response
    */
    public function show($id)
    {
        if($_POST){
            $this->post($id);
        }

        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
        $comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAllByParam(['post_id' => $id, 'valid' => 1]);
        $nbComments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->countParam(['post_id' => $billet->getId(), 'valid' => 1]);

        $pages = new Paginate(5, (int) $nbComments['count'], 3);
        dump($pages);
        return $this->render("billet.html.twig", ['billet' => $billet, 'comments' => $comments, 'nbComments' => $nbComments, 'pages' => $pages]);
    }

    /**
     * @param string $id
     * @return header
     */
    private function post($id)
    {
        $dataForm = $_POST;
        $author = addslashes(array_shift($dataForm));
        $content = addslashes(array_shift($dataForm));
        
        $dataForm["content"] = $content;

        $date = new \Datetime;
        date_timezone_set($date, timezone_open('Europe/Paris'));
        $date = $date->format("Y-m-d H:i:s");
        $dataForm["posted_at"] = $date;

        $dataForm["valid"] = 1;
        $dataForm["report"] = 0;
        $dataForm["author"] = $author;
        $dataForm["post_id"] = $id;

        $dataForm = $this->getDatabase()->getManager('\Project\Model\CommentModel')->insert('comment', $dataForm);

        $_POST = null;
        (string)$redirect = '/billet/' . $id;
        header('Location :' . $redirect);
    }// Re-écrire la fonction avec prepare puis execute

}