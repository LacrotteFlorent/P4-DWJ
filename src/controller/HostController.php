<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\ORM\Database;

class HostController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit("post", 3);

        return $this->render("host.html.twig", ['billets' => $billets]);

    }

}