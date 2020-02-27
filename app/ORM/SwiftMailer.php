<?php

namespace Framework\ORM;

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
    public static function getInstance(int $port, string $tlsOrSsl) : SwiftMailer
    {
        if(!self::$swiftMailerInstance) {
            self::$swiftMailerInstance = new SwiftMailer(
                $_SERVER["MAIL_SMTP"],
                $_SERVER["MAIL_USER"],
                $_SERVER["MAIL_PASS"],
                $port,
                $tlsOrSsl
            );
        }
        return self::$swiftMailerInstance;
    }

    /**
     * SwiftMailer constructor.
     * @param string $smtp
     * @param string $user
     * @param string $pass
     * @source https://swiftmailer.symfony.com/docs/sending.html
     */
    public function __construct(string $smtp, string $user, string $pass, int $port, string $tlsOrSsl)
    {
        $this->transport = (new \Swift_SmtpTransport($smtp, $port, $tlsOrSsl))
            ->setUsername($user)
            ->setPassword($pass)
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