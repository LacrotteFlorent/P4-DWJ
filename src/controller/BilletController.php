<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\ORM\Database;

class BilletController extends Controller
{
   /**
    * @param string $id
    * @return render()
    */
    public function afficherBillet($id)
    {
        $billet = $this->getDatabase()->getManager('\Project\Model\BilletModel')->find($id);
        dd($billet);
        return $this->render("testBillet.html.twig", [
            'billet' => $billet
        ]);
    }

}