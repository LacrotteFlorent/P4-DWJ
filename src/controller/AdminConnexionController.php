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
                    $connect = ((($this->getDatabase()->getManager('\Project\Model\UserModel')->countParam(['password' => md5($_POST["password"]), 'username' => $_POST["login"]]))['count']));
                    if($connect === "1"){
                        $_SESSION['login'] = $_POST['login'];
                        FlashBag::getInstance()->add("green", "Vous êtes maintenant connecté");
                    }
                    elseif($connect === "0"){
                        FlashBag::getInstance()->add("red", "Mot de passe / identifiants inconu.");
                    }
                    else{
                        throw new SrcControllerException("Two users have the same couple user mdp");
                    }
                    return $this->redirection('/adminConnexion');
                }
            else{
                return $this->redirection('/adminConnexion');
                FlashBag::getInstance()->add("red", "Il y a eu une erreur inconnue lors de votre connexion!");
            }
        }
        FlashBag::getInstance()->add("red", "Il y a eu une erreur inconnue lors de votre connexion!");
        return $this->redirection('/adminConnexion');
    }

    /**
    * @return RedirectionResponse
    */
    public function signUp()
    {
        if($this->request->getRequestMethod() === 'POST'){
            $userModel = (new UserModel())->hydrateForSql([
                "password"      => $_POST["password"],
                "username"      => $_POST["login"],
                "email"         => $_POST["email"]
            ]);
            if((new Validator)->assertion($userModel, [
            'submit'    => [
                'value'     => $_POST["submit"],
                'assert'    => 'string'
            ]], true)){
                    $connect = ((($this->getDatabase()->getManager('\Project\Model\UserModel')->countParam(['username' => $_POST["login"]]))['count']));
                    if($connect === "1"){
                        FlashBag::getInstance()->add("green", "Cet identifiant existe déja.");
                    }
                    elseif($connect === "0"){
                        // faire un input
                    }
                    else{
                        throw new SrcControllerException("FATAL ERROR : Two users have the same couple user mdp");
                    }
                    return $this->redirection('/adminConnexion');
                }
            else{
                return $this->redirection('/adminConnexion');
                FlashBag::getInstance()->add("red", "Il y a eu une erreur inconnue lors de votre connexion!");
            }
        }
        FlashBag::getInstance()->add("red", "Il y a eu une erreur inconnue lors de votre connexion!");
        return $this->redirection('/adminConnexion');
    }

    /**
    * @return RedirectionResponse
    */
    public function disconnect()
    {
        session_unset();
        
        FlashBag::getInstance()->add("blue", "Vous êtes maintenant deconnecté");
        return $this->redirection('/adminConnexion');
    }

}