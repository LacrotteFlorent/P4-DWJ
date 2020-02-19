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
    public function showBillet($id)
    {
        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findAll($id, "post");
        dump($billet);
        dump($this->pullAltImage($billet->getImageId()));
        
        return $this->render("testBillet.html.twig", ['billet' => [
            'id'                => $billet->getId(),
            'title'             => $billet->getTitle(),
            'content'           => $this->deleteFirstCarac($billet->getContent()),
            'firstCaracContent' => $this->catchFirstCarac($billet->getContent()),
            'imageUrl'          => "../public/img/" . $this->pullImage($billet->getImageId()),
            'altImage'          => $this->pullAltImage($billet->getImageId())
        ]]);
    }

    private function showComments()
    {
        $comments = $this->getDatabase()->getManager('\Project\Model\CommentModel')->findAll($id, "comment");
    }

    /**
     * @param string $content
     * @return string $contentWithoutFirst
     */
    private function deleteFirstCarac($content)
    {
        $stringWithoutFirst = substr($content, 1);
        return $stringWithoutFirst;
    }

    /**
     * @param string $caracString
     * @return string $firstCarac
     */
    private function catchFirstCarac($content)
    {
        $firstCarac = $content{0};
        return ucfirst($firstCarac);
    }

    /**
     * @param int $idImage
     * @return string
     */
    private function pullImage($idImage)
    {
        $imageBillet = $this->getDatabase()->getManager('\Project\Model\ImageModel')->findAll($idImage, "image");
        return $imageBillet->getName();
    }

    /**
     * @param int $idImage
     * @return string
     */
    private function pullAltImage($idImage)
    {
        $imageBillet = $this->getDatabase()->getManager('\Project\Model\ImageModel')->findAll($idImage, "image");
        return $imageBillet->getAlt();
    }

}