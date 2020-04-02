<?php

namespace Framework;

class SwiftMailer
{

    /**
     * @var Swift_SmtpTransport
     */
    private $transport;

    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var SwiftMailer
     */
    private static $swiftMailerInstance;

    /**
     * @param string $tlsOrSsl
     * @internal { @param $tlsOrSsl => put 'ssl' or 'tls' }}
     * @param int $port
     * @internal { for Gmail use 587 for tls }}
     * @internal { for Gmail use 465 for ssl }}
     * @static
     * @return SwiftMailer
     */
    public static function getInstance() : SwiftMailer
    {
        if(!self::$swiftMailerInstance) {
            self::$swiftMailerInstance = new SwiftMailer();
        }
        return self::$swiftMailerInstance;
    }

    /**
     * SwiftMailer constructor.
     * @source https://swiftmailer.symfony.com/docs/sending.html
     * @internal { for Gmail use 587 for tls }}
     * @internal { for Gmail use 465 for ssl }}
     */
    public function __construct()
    {
        $this->transport = (new \Swift_SmtpTransport($_ENV["MAIL_SMTP"], $_ENV["MAIL_PORT"], $_ENV["MAIL_PROTOCOLE"]))
            ->setUsername($_ENV["MAIL_USER"])
            ->setPassword(["MAIL_PASS"])
        ;
        $this->mailer = new \Swift_Mailer($this->transport);
    }

    /**
     * @return \Swift_SmtpTransport
     */
    public function getTransport() : \Swift_SmtpTransport
    {
        return $this->transport;
    }

    /**
     * @return \Swift_Mailer
     */
    public function getMailer() : \Swift_Mailer
    {
        return $this->mailer;
    }

}