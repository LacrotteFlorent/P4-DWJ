<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class BilletController extends Controller
{
   /**
    * @param string $id
    * @return render()
    */
    public function afficherBillet($id)
    {
        $billet = $this->getDatabase()->getManager(BilletController::class)->find($id);
        dd($billet);
        return $this->render("testBillet.html.twig", [
            'billet' => $billet
        ]);
    }

}