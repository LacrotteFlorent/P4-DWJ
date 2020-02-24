<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class BlogController extends Controller
{
   /**
    * @param string $id
    * @return Response
    */
    public function show()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit("post", 5);
        dump($billets);
   
        return $this->render("blog.html.twig", ['billets' => $billets]);
    }

}
