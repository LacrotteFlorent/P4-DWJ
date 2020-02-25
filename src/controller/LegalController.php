<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class LegalController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        return $this->render("legal.html.twig");
    }

}