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
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findOrderByLimitOffset("3", "0", "posted_at", null, ["draft" => 0, "posted_at" => date($_ENV["DATE_FORMAT"])], '<=');
        foreach($billets as $billet){
            $imageBillets[$billet->getId()] = $this->getDatabase()->getManager('\Project\Model\ImageModel')->find($billet->getImageId(), "image");
        }

        return $this->render("host.html.twig", [
            'billets'   => $billets,
            'images'    => $imageBillets
        ]);
    }

}