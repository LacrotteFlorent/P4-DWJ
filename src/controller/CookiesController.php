<?php

namespace Project\Controller;

use Framework\Controller;

class CookiesController extends Controller
{

    /**
    * @return RedirectionResponse
    */
    public function valid()
    {   
        if($this->request->getRequestMethod() === 'POST'){
            $_SESSION['cookies'] = true;
            return $this->redirection('/host');
        }
        return $this->redirection('/host');
    }

    /**
    * @return RedirectionResponse
    */
    public function refused()
    {   
        if($this->request->getRequestMethod() === 'POST'){
            $_SESSION['cookies'] = true;
            return $this->redirection('/host');
        }
        return $this->redirection('/host');
    }

}