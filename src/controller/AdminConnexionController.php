<?php

namespace Project\Controller;

use Framework\Controller;
use Framework\Form\Validator;
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
                "password"      => $_POST["password"],
                "username"      => 'unknown',
                "email"         => $_POST["login"]
            ]);
            if((new Validator)->assertion($userModel, [
            'submit'    => [
                'value'     => $_POST["submit"],
                'assert'    => 'string'
            ]], true)){
                    $userPass = ($this->getDatabase()->getManager('\Project\Model\UserModel')->findSelectByParam('*', ['email' => $_POST["login"]]))[0]->getPassword();
                    if (password_verify($_POST["password"], $userPass)) {
                        $_SESSION['login'] = $_POST['login'];
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