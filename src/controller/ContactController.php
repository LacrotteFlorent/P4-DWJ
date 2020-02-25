<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class ContactController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        return $this->render("contact.html.twig");
    }

}