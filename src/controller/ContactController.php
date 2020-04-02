<?php

namespace Project\Controller;

use Framework\Form\Validator;
use Framework\Controller;
use Framework\FlashBag;
use Framework\SwiftMailer;
use Project\Model\ContactModel;

class ContactController extends Controller
{

    /**
    * @var CONST $debutAutoResponse
    */
    CONST STARTAUTORESPONSE = "
    Bonjour, \r\n
    Ceci est un message envoyé automatiquement via le site https://www.jean-forteroche-p4-lacrotte.fr . \r\n
    Vous avez fait une demande de contact avec le contenu suivant : \r\n
    ";

    /**
    * @var CONST $finAutoResponse
    */
    CONST ENDAUTORESPONSE = "
    Votre message à bien été envoyé, \r\n
    En vous remerciant, \r\n
    ForteRoche Jean.
    ";

    /**
    * @return Response
    */
    public function show()
    {
        return $this->render("contact.html.twig");
    }

   /**
    * @return Redirection
    */
    public function contact()
    {
        if($this->request->getRequestMethod() === 'POST'){
            $contactModel = (new ContactModel())->hydrateForSql([
                "full_name" => $_POST["contactFirstName"] .' : '. $_POST["contactName"],
                "email"     => $_POST["contactMail"],
                "subject"   => $_POST["contactObject"],
                "content"   => $_POST["contactMessage"],
                "sent_at"   => date($_ENV["DATE_FORMAT"])
            ]);
        
            if((new Validator)->assertion($contactModel, [
                'rgpd'      => [
                    'value'     => $_POST["acceptRGPD_contact"],
                    'assert'    => 'checkbox'
                ],
                'submit'    => [
                    'value'     => $_POST["submit"],
                    'assert'    => 'string'
                ]], true)){
                $this->getDatabase()->getManager('\Project\Model\ContactModel')->insertByModel($contactModel);

                    // send a email to recipent to notify it
                $failure = null;
                $message = (new \Swift_Message('Prise de contact Site Web'))
                    ->setFrom(['swift.mailer.lacrotte.florent@gmail.com' => 'Contact Site JeanForteroche'])
                    ->setTo(['bralocaz@gmail.com' => 'Bralocaz'])
                    ->setBody('Vous avez reçu une nouvelle demande de contact :' . $_POST['contactMessage'])
                    ;
                (SwiftMailer::getInstance())->getMailer()->send($message, $failure);

                    // send a email to sender to notify it
                $message = (new \Swift_Message('Contact Jean Forteroche'))
                    ->setFrom(['swift.mailer.lacrotte.florent@gmail.com' => 'Jean Forteroche'])
                    ->setTo([$_POST['contactMail'] => $_POST['contactName']])
                    ->setBody(self::STARTAUTORESPONSE . $_POST['contactMessage'] . self::ENDAUTORESPONSE)
                    ;
                (SwiftMailer::getInstance())->getMailer()->send($message, $failure);

                    // return message on the contact page
                if($failure){
                    (FlashBag::getInstance())->add("red", "Une erreur c'est produite, votre message n'as pas été envoyé !");
                    return $this->redirection('/contact');
                }

                (FlashBag::getInstance())->add("green", "Votre message à bien été envoyé !");
                return $this->redirection('/contact');
            }
        }
        else{
            (FlashBag::getInstance())->add("red", "Une erreur inconnue c'est produite !");
        }
        return $this->redirection('/contact');
    }

}