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
     * @static
     * @return SwiftMailer
     */
    public static function getInstance() : SwiftMailer
    {
        if(!self::$swiftMailerInstance) {
            self::$swiftMailerInstance = new SwiftMailer(
                $_SERVER["MAIL_SMTP"],
                $_SERVER["MAIL_USER"],
                $_SERVER["MAIL_PASS"]
            );
        }
        return self::$swiftMailerInstance;
    }

    /**
     * SwiftMailer constructor.
     * @param string $smtp
     * @param string $user
     * @param string $pass
     */
    public function __construct($smtp, $user, $pass)
    {
        $this->transport = (new \Swift_SmtpTransport($smtp, 587, 'tls'))
            ->setUsername($user)
            ->setPassword($pass)
        ;
        $this->mailer = new \Swift_Mailer($this->transport);
    }

    /**
     * @return \Swift_SmtpTransport
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @return \Swift_Mailer
     */
    public function getMailer()
    {
        return $this->mailer;
    }

}