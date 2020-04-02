<?php

namespace Project\Controller;

use Framework\Controller;
use Framework\Form\Validator;
use Framework\FlashBag;
use Framework\SwiftMailer;
use Project\Model\UserModel;

class SignUpConnexionController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        return $this->render("signUp.html.twig");
    }

    /**
    * @return RedirectionResponse
    */
    public function sign()
    {
        if($this->request->getRequestMethod() === 'POST'){
            $userModel = (new UserModel())->hydrateForSql([
                "password"      => md5($_POST["password"]),
                "username"      => $_POST["login"],
                "email"         => $_POST["mail"]
            ]);
            if((new Validator)->assertion($userModel, [
                'rgpd'      => [
                    'value'     => $_POST["acceptRGPD"],
                    'assert'    => 'checkbox'
                ],
                'submit'    => [
                    'value'     => $_POST["submit"],
                    'assert'    => 'string'
            ]], true)){
                    $connectUser = ((($this->getDatabase()->getManager('\Project\Model\UserModel')->countParam(['username' => $_POST["login"]]))['count']));
                    $connectMail = ((($this->getDatabase()->getManager('\Project\Model\UserModel')->countParam(['email' => $_POST["mail"]]))['count']));
                    if($connectUser === "1" && $connectMail === "1"){
                        FlashBag::getInstance()->add("orange", "Cet identifiant / mail existe déja.");
                        return $this->redirection('/signUpConnexion');
                    }
                    elseif($connectUser === "0" && $connectMail === "0"){
                        $this->getDatabase()->getManager('\Project\Model\UserModel')->insertByModel($userModel);
                        FlashBag::getInstance()->add("green", "Vous êtes maitenant inscrit");

                            // send a email to recipent to notify it
                        $failure = null;
                        $message = (new \Swift_Message('Prise de contact Site Web'))
                        ->setFrom(['swift.mailer.lacrotte.florent@gmail.com' => 'Inscription Site JeanForteroche'])
                        ->setTo([$_POST['mail'] => $_POST['login']])
                        ->setBody("Vous êtes maintenant inscrit sur l'espace membre de JeanForteroche")
                        ;
                        (SwiftMailer::getInstance())->getMailer()->send($message, $failure);
                        return $this->redirection('/adminConnexion');
                    }
                    else{
                        throw new SrcControllerException("FATAL ERROR : Two users have the same couple user mdp");
                    }
                    return $this->redirection('/adminConnexion');
                }
            else{
                return $this->redirection('/adminConnexion');
                FlashBag::getInstance()->add("red", "Il y a eu une erreur inconnue lors de votre inscription !");
            }
        }
        FlashBag::getInstance()->add("red", "Il y a eu une erreur inconnue lors de votre inscription !");
        return $this->redirection('/adminConnexion');
    }

}