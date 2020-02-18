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
    public function afficherBillet($id)
    {
        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
        dump($billet);
        return $this->render("testBillet.html.twig", ['billet' => [
            'id'                => $billet->getId(),
            'title'             => $billet->getTitle(),
            'content'           => $this->deleteFirstCarac($billet->getContent()),
            'firstCaracContent' => $this->catchFirstCarac($billet->getContent()),
            'createdAt'         => $billet->getCreatedAt(),
            'postedAt'          => $billet->getPostedAt(),
            'imageId'           => $billet->getImageId(),
        ]]);
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

}