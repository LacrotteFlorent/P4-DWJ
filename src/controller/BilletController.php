<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\ORM\Database;

class BilletController extends Controller
{
   /**
    * @param string $id
    * @return Response
    */
    public function show($id)
    {
        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id, "post");
        $comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findByParam("post_id" ,$id, "comment");

        return $this->render("testBillet.html.twig", ['billet' => $billet, 'comments' => $comments]);
        
    }

    /**
     * @param int $idPost
     * @return array
     */
    private function showComments($idPost)
    {
        $comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findByParam("post_id" ,$idPost, "comment");

        $data = [];
        foreach($comments as $comment){
            array_push($data, [
                'author'        => $this->replaceAuthor($comment->getAuthor()),
                'content'       => $comment->getContent(),
                'postedAt'      => $comment->getPostedAt()
            ]);
        }

        dump($data);
        return $data;
    }

    

    

    /**
     * @param int $idImage
     * @return string
     */
    private function pullImage($idImage)
    {
        $imageBillet = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($idImage, "image");
        return $imageBillet->getName();
    }

    /**
     * @param int $idImage
     * @return string
     */
    private function pullAltImage($idImage)
    {
        $imageBillet = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($idImage, "image");
        return $imageBillet->getAlt();
    }

    /**
     * @param string $author
     * @return string
     */
    private function replaceAuthor($author)
    {
        if(!$author){
            $author = "Guest";
        }

        return $author;
    }

}