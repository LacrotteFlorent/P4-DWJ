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
        return $this->render("adminConnexion.html.twig");
    }

    /**
    * @return RedirectionResponse
    */
    public function connect()
    {
        if($this->request->getRequestMethod() === 'POST'){
            $userModel = (new UserModel())->hydrateForSql([
                "password"      => $_POST["password"],
                "username"      => $_POST["login"]
            ]);
            if((new Validator)->assertion($userModel, [
            'submit'    => [
                'value'     => $_POST["submit"],
                'assert'    => 'string'
            ]], true)){
                    $connectUser = ((($this->getDatabase()->getManager('\Project\Model\UserModel')->countParam(['password' => md5($_POST["password"]), 'username' => $_POST["login"]]))['count']));
                    $connectMail = ((($this->getDatabase()->getManager('\Project\Model\UserModel')->countParam(['password' => md5($_POST["password"]), 'email' => $_POST["login"]]))['count']));
                    if($connectUser === "1" || $connectMail === "1"){
                        $_SESSION['login'] = $_POST['login'];
                        FlashBag::getInstance()->add("green", "Vous êtes maintenant connecté");
                    }
                    elseif($connectUser === "0" && $connectMail === "0"){
                        FlashBag::getInstance()->add("red", "Mot de passe / identifiants inconu.");
                        return $this->redirection('/adminConnexion');
                    }
                    else{
                        throw new SrcControllerException("Two users have the same couple user mdp");
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
        session_unset();
        FlashBag::getInstance()->add("blue", "Vous êtes maintenant deconnecté");
        return $this->redirection('/host');
    }

}