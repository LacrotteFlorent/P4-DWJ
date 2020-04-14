<?php

namespace Project\Controller;

use Framework\Form\Validation\StringConstraint;
use Framework\Form\Validation\SameConstraint;
use Framework\Form\Validation\Validator;
use Framework\Controller;
use Framework\FlashBag;
use Project\Model\UserModel;

class AdminConnexionController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        return $this->render("adminConnexion.html.twig",[
            'login'    => !empty($_SESSION['login']) ? true : false,
        ]);
    }

    /**
    * @return RedirectionResponse
    */
    public function connect()
    {
        if($this->request->getRequestMethod() === 'POST'){
            $userModel = (new UserModel())->hydrateForSql([
                "password"      => $this->request->getPost()["password"],
                "username"      => 'unknown',
                "email"         => $this->request->getPost()["login"],
                "role"          => 'unknown'
            ]);
            if((new Validator)->assertion($userModel, [
            'submit'    => [
                'value'         => $this->request->getPost()["submit"],
                "constraints"   => [new StringConstraint(), new SameConstraint('connect')]
            ]], true)){
                    $userPass = ($this->getDatabase()->getManager('\Project\Model\UserModel')->findSelectByParam('*', ['email' => $this->request->getPost()["login"]]));
                    if(isset($userPass[0])){
                        $userPass = $userPass[0]->getPassword();
                    }
                    else{
                        FlashBag::getInstance()->add("red", "Mot de passe / identifiants inconu.");
                        return $this->redirection('/adminConnexion');
                    }
                    if (password_verify($this->request->getPost()["password"], $userPass)) {
                        $_SESSION['login'] = $this->request->getPost()['login'];
                        FlashBag::getInstance()->add("green", "Vous êtes maintenant connecté");
                    } else {
                        FlashBag::getInstance()->add("red", "Mot de passe / identifiants inconu.");
                        return $this->redirection('/adminConnexion');
                    }
                    return $this->redirection('/host');
                }
            else{
                return $this->redirection('/adminConnexion');
                FlashBag::getInstance()->add("red", "Il y a eu une erreur inconnue lors de votre connexion !");
            }
        }
        FlashBag::getInstance()->add("red", "Il y a eu une erreur inconnue lors de votre connexion !");
        return $this->redirection('/adminConnexion');
    }

    /**
    * @return RedirectionResponse
    */
    public function disconnect()
    {
        unset($_SESSION['login']);
        FlashBag::getInstance()->add("blue", "Vous êtes maintenant deconnecté");
        return $this->redirection('/host');
    }

}