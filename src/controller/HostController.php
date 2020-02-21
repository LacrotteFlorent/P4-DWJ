<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\ORM\Database;

class HostController extends Controller
{
   /**
    * @param string $id
    * @return Response
    */
    public function showHost()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit("post", 3);

        $data = [];
        foreach($billets as $billet){
            array_push($data, [
                'title'        => $billet->getTitle(),
                'content'      => $this->reduceContent($billet->getContent(), 500),
                'imageUrl'     => ("../public/img/" . $this->pullImage($billet->getImageId())),
                'altImage'     => $this->pullAltImage($billet->getImageId()),
                'postedAt'     => $billet->getPostedAt()
            ]);
        }

        return $this->render("host.html.twig", ['billets' => $data]);
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
     * @param string $content
     * @param int $nbCarac
     * @return string
     */
    private function reduceContent($content, $nbCarac)
    {
        $reduce = substr($content, 0, $nbCarac);
        
        return $reduce . " ...";
    }

}