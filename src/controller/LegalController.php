<?php

namespace Project\Controller;

use Framework\Controller;

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