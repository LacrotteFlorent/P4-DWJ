<?php

namespace Project\Controller;

use Framework\Controller;

class HostController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit(3);
        foreach($billets as $billet){
            $imageBillets[$billet->getId()] = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($billet->getImageId(), "image");
        }

        return $this->render("host.html.twig", [
            'billets'   => $billets,
            'images'    => $imageBillets
        ]);
    }

}