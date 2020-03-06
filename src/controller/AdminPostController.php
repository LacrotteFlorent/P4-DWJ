<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class AdminPostController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        return $this->render("adminPost.html.twig");
    }

}