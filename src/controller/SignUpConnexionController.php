<?php

namespace Project\Controller;

use Framework\Form\Validation\CheckboxConstraint;
use Framework\Form\Validation\StringConstraint;
use Framework\Form\Validation\Validator;
use Framework\SwiftMailer;
use Framework\Controller;
use Framework\FlashBag;
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
                "password"      => password_hash(($_POST["password"]), PASSWORD_DEFAULT),
                "username"      => $_POST["login"],
                "email"         => $_POST["mail"],
                "role"          => "ROLE_USER"
            ]);
            if((new Validator)->assertion($userModel, [
                'rgpd'      => [
                    'value'     => $_POST["acceptRGPD"],
                    "constraints"   => [new CheckboxConstraint()]
                ],
                'submit'    => [
                    'value'         => $_POST["submit"],
                    "constraints"   => [new StringConstraint()]
            ]], true)){
                    $connectUser = ((($this->getDatabase()->getManager('\Project\Model\UserModel')->countParam(['username' => $_POST["login"]]))['count']));
                    $connectMail = ((($this->getDatabase()->getManager('\Project\Model\UserModel')->countParam(['email' => $_POST["mail"]]))['count']));
                    if($connectUser + $connectMail >= 1){
                        FlashBag::getInstance()->add("orange", "Cet identifiant / mail existe déja.");
                        return $this->redirection('/signUpConnexion');
                    }
                    else{
                        $this->getDatabase()->getManager('\Project\Model\UserModel')->insertByModel($userModel);
                        FlashBag::getInstance()->add("green", "Vous êtes maitenant inscrit");

                            // send a email to recipent to notify it
                        $failure = null;
                        $message = (new \Swift_Message('Prise de contact Site Web'))
                        ->setFrom(['swift.mailer.lacrotte.florent@gmail.com' => 'Inscription Site JeanForteroche'])
                        ->setTo([$_POST['mail'] => $_POST['mail']])
                        ->setBody("Vous êtes maintenant inscrit sur l'espace membre de JeanForteroche")
                        ;
                        (SwiftMailer::getInstance())->getMailer()->send($message, $failure);
                        return $this->redirection('/adminConnexion');
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