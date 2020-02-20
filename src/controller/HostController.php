<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\ORM\Database;

class HostController extends Controller
{
   /**
    * @todo modifier la fonction pour que le tableau de  ModelBillet/billet soit traité
    * @param string $id
    * @return Response
    */
    public function showHost()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit("post", 4);
        dump($billets);
        //dump($this->pullAltImage($billet->getImageId()));

        return $this->render("host.html.twig", [
                'billet' =>[
                    'title'             => $billet->getTitle(),
                    'content'           => $billet->getContent(),
                    'imageUrl'          => "../public/img/" . $this->pullImage($billet->getImageId()),
                    'altImage'          => $this->pullAltImage($billet->getImageId())
        ]]);
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

}