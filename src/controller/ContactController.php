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
    * @return Response
    */
    public function show()
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
                ]
            ])){
                $this->getDatabase()->getManager('\Project\Model\ContactModel')->insertByModel($contactModel);

                    // send a email to recipent to notify it
                $failure = null;
                $message = (new \Swift_Message('Prise de contact Site Web'))
                    ->setFrom(['swift.mailer.lacrotte.florent@gmail.com' => 'Contact Site JeanForteroche'])
                    ->setTo(['bralocaz@gmail.com' => 'Bralocaz'])
                    ->setBody('Vous avez reçu une nouvelle demande de contact :' . $_POST['contactMessage'])
                    ;
                $result = (SwiftMailer::getInstance())->getMailer()->send($message, $failure);

                    // send a email to sender to notify it
                $startContentMailAuto = "
                    Bonjour, \r\n
                    Ceci est un message envoyé automatiquement via le site https://www.jean-forteroche-p4-lacrotte.fr . \r\n
                    Vous avez fait une demande de contact avec le contenu suivant : \r\n
                    ";
                $endContentMailAuto = "
                    Votre message à bien été envoyé, \r\n
                    En vous remerciant, \r\n
                    ForteRoche Jean.
                    ";
                $message = (new \Swift_Message('Contact Jean Forteroche'))
                    ->setFrom(['swift.mailer.lacrotte.florent@gmail.com' => 'Jean Forteroche'])
                    ->setTo([$_POST['contactMail'] => $_POST['contactName']])
                    ->setBody($startContentMailAuto . $_POST['contactMessage'] . $endContentMailAuto)
                    ;
                $result = (SwiftMailer::getInstance())->getMailer()->send($message, $failure);

                    // return message on the contact page
                if($failure){
                    $infoMail = "Une erreur c'est produite, votre message n'as pas été envoyé !";
                    $bgColorInfo = "red";
                    (FlashBag::getInstance())->add($bgColorInfo, $infoMail);
                    return $this->redirection('/contact');
                }
                else{
                    $infoMail = " Votre message à bien été envoyé !";
                    $bgColorInfo = "green";
                    (FlashBag::getInstance())->add($bgColorInfo, $infoMail);
                    return $this->redirection('/contact');
                }
            }
        }

        return $this->render("contact.html.twig");
    }

}