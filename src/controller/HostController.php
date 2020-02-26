<?php

namespace Project\Controller;

use Framework\ORM\Controller;

class HostController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        $billets = $this->getDatabase()->getManager('\Project\Model\BilletModel')->findByPostedAtWithLimit(3);

        return $this->render("host.html.twig", ['billets' => $billets]);
    }

}