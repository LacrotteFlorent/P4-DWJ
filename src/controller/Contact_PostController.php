<?php

namespace Project\Controller;

use Framework\ORM\Controller;
use Framework\ORM\SwiftMailer;

class Contact_PostController extends Controller
{
   /**
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

        // ATTENTION A LA SECURITEE => ENLEVER LES ENTREES EN CARAC HTLM / JS ou autre
        // Si la requete est validée plusieurs fois rapidement que faire ?
        // autre suggestions sécuritée .?


        // on rentre les données du formulaire dans la BDD



            // on envoi un mail au destinataire pour notifier le message
        
        $message = (new \Swift_Message('Prise de contact Site Web'))
            ->setFrom(['swift.mailer.lacrotte.florent@gmail.com' => 'Contact Site JeanForteroche'])
            ->setTo(['bralocaz@gmail.com' => 'Bralocaz'])
            ->setBody('Vous avez reçu une nouvelle demande de contact :' . $_POST['contactMessage'])
            ;
        $result = (SwiftMailer::getInstance(587,'tls'))->getMailer()->send($message);

            // on envoi un email à l'expediteur pour notifier que son message à bien été envoyé

        $startContentMailAuto = "
            Bonjour, \n
            Ceci est un message envoyé automatiquement via le site https://www.jean-forteroche-p4-lacrotte.fr . \n
            Vous avez fait une demande de contact avec le contenu suivant : \n
            ";
        $endContentMailAuto = "
            Votre message à bien été envoyé, \n
            En vous remerciant, \n
            ForteRoche Jean.
            ";
        $message = (new \Swift_Message('Contact Jean Forteroche'))
            ->setFrom(['swift.mailer.lacrotte.florent@gmail.com' => 'Jean Forteroche'])
            ->setTo([$_POST['contactMail'] => $_POST['contactName']])
            ->setBody($startContentMailAuto . $_POST['contactMessage'] . $endContentMailAuto)
            ;
        $result = (SwiftMailer::getInstance(587,'tls'))->getMailer()->send($message);

            // on retourne le message suivant sur la page /contact

        $infoMail = " Votre message à bien été envoyé !";
        $bgColorInfo = "bg-success";

        return $this->render("contact.html.twig", ['message' => $infoMail, 'bgColorMessage' => $bgColorInfo]);
    }

}