<?php
/**
 * Created by PhpStorm.
 * User: arb
 * Date: 05/06/2018
 * Time: 13:34
 */

namespace DI\PlatformBundle\Email;


use DI\PlatformBundle\Entity\Application;

class ApplicationMailer
{

    private $mailer;

    /**
     * ApplicationMailer constructor.
     * @param $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendNotification(Application $application) {

        $message = new \Swift_Message(
            'Nouvelle candidature',
            'Bonjour, Vous avez reçu une nouvelle candidature.'
        );

        $message->addTo($application->getAdvert()->getAuthor());
        $message->addFrom('contact@diplatforme.com');

        $this->mailer->send($message);

    }

    public function sendConfirmation(Application $application) {

        $message = new \Swift_Message(
            'Confirmation de candidature',
            'Bonjour, nous vous confirmons que votre candidature a bien été envoyée.'
        );

        $message->addTo($application->getAuthor());
        $message->addFrom('contact@diplatforme.com');

        $this->mailer->send($message);

    }


}