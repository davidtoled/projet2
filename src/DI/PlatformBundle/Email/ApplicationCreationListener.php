<?php
/**
 * Created by PhpStorm.
 * User: arb
 * Date: 05/06/2018
 * Time: 15:35
 */

namespace DI\PlatformBundle\Email;



use DI\PlatformBundle\Entity\Application;
use DI\PlatformBundle\Email\ApplicationMailer;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class ApplicationCreationListener
{

    private $applicationMailer;

    /**
     * ApplicationCreationListener constructor.
     * @param $applicationMailer
     */
    public function __construct(ApplicationMailer $applicationMailer)
    {
        $this->applicationMailer = $applicationMailer;
    }


    public function postPersist(LifecycleEventArgs $args) {

        $entity = $args->getObject();

        if (!$entity instanceof Application) {
            return;
        }

        $this->applicationMailer->sendNotification($entity);

    }

}