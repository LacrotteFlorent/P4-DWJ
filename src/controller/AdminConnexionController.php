<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class AdminConnexionController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {

        return $this->render("adminConnexion.html.twig");

    }

}