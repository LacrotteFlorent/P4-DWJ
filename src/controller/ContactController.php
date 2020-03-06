<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\MessageFlash;
use Framework\SwiftMailer;

class ContactController extends Controller
{
   /**
    * @return Response
    */
    public function show()
    {
        if($_POST){
            $this->post();
        }

        $flashMessages = $this->flashMessages();
        return $this->render("contact.html.twig", ['flashMessages' => $flashMessages]);
    }

    /**
     * @return RedirectionResponse
     */
    private function post()
    {
            // insert in MYSQL
        $dataForm = [];
        $dataForm["full_name"] = (addslashes($_POST["contactFirstName"]) . ' : '. addslashes($_POST["contactName"]));
        $dataForm["email"] = $_POST["contactMail"];
        $dataForm["subject"] = addslashes($_POST["contactObject"]);
        $dataForm["content"] = addslashes($_POST["contactMessage"]);

        $date = new \Datetime;
        date_timezone_set($date, timezone_open('Europe/Paris'));
        $date = $date->format("Y-m-d H:i:s");
        $dataForm["sent_at"] = $date;

        $dataForm = $this->getDatabase()->getManager('\Project\Model\ContactModel')->insertPrepare('contact', $dataForm);

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
            $bgColorInfo = "bg-danger";
            $flashMessage = (MessageFlash::getInstance())->add($bgColorInfo, $infoMail);
        }
        else{
            $infoMail = " Votre message à bien été envoyé !";
            $bgColorInfo = "bg-success";
            $flashMessage = (MessageFlash::getInstance())->add($bgColorInfo, $infoMail);
        }

        $_POST = null;

        $this->redirection('/contact');
    }
}