<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\ORM\SwiftMailer;

class Contact_PostController extends Controller
{
   /**
    * @source https://symfony.com/doc/current/email.html
    * @return Response
    */
    public function post()
    {
	    // // Ma clé privée
	    // $secret = "6LfynM0UAAAAAA8uukzkdMsu6RJnQvP5Rz-vi7OM";
	    // // Paramètre renvoyé par le recaptcha
	    // $response = $_POST['g-recaptcha-response'];
	    // // On récupère l'IP de l'utilisateur
	    // $remoteip = $_SERVER['REMOTE_ADDR'];
        // 
	    // $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
	    //     . $secret
	    //     . "&response=" . $response
	    //     . "&remoteip=" . $remoteip ;
        // 
	    // $decode = json_decode(file_get_contents($api_url), true);
        // 
	    // if ($decode['success'] == true) {
	    // 	// C'est un humain
	    // 	dump($_POST);
	    // }
    
	    // else {
	    // 	// C'est un robot ou le code de vérification est incorrect
        // }

        dump($_POST);
        dump($_POST['contactMail']);

        // on rentre les données du formulaire dans la BDD



            // on envoi un mail au destinataire pour notifier le message
        
        $message = (new \Swift_Message('Prise de contact Site Web'))
        ->setFrom(['swift.mailer.lacrotte.florent@gmail.com' => 'Contact Site JeanForteroche'])
        ->setTo(['bralocaz@gmail.com' => 'Bralocaz'])
        ->setBody('Vous avez reçu une nouvelle demande de contact :' . $_POST['contactMessage'])
        ;
        $result = (SwiftMailer::getInstance())->getMailer()->send($message);

            // on envoi un email à l'expediteur pour notifier que son message à bien été envoyé

        $message = (new \Swift_Message('Contact Jean Forteroche'))
        ->setFrom(['swift.mailer.lacrotte.florent@gmail.com' => 'Jean Forteroche'])
        ->setTo([$_POST['contactMail'] => $_POST['contactName']])
        ->setBody($_POST['contactMessage'])
        ;
        $result = (SwiftMailer::getInstance())->getMailer()->send($message);

            // on retourne le message suivant sur la page /contact
            
        $message = " Votre message à bien été envoyé !";
        $bgColorMessage = "bg-success";

        return $this->render("contact.html.twig", ['message' => $message, 'bgColorMessage' => $bgColorMessage]);
    }

}