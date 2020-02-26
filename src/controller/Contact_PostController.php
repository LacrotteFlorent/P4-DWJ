<?php

namespace Project\Controller;

use Framework\ORM\Controller;

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



        // on envois un mail au destinataire pour notifier le message
            // renseigner l'adresse mail dans le dashboard ? et pouvoir activer l'envois de mail
        
        
            



        // on envois un email à l'expediteur pour notifier que son message à bien été envoyé
        // et on retourne son message

        sendEmail();
        $message = " Votre message à bien été envoyé !";
        $bgColorMessage = "bg-success";

        return $this->render("contact.html.twig", ['message' => $message, 'bgColorMessage' => $bgColorMessage]);
    }

    public function sendEmail(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom($_POST['contactMail'])
            ->setTo('lacrotte.florent@gmail.com')
            ->setBody('You should see me from the profiler!')
        ;
    
        $mailer->send($message);
    
        // ...
    }

}