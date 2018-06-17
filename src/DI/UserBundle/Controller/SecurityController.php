<?php

namespace DI\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{

    public function loginAction() {

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('di_platform_homepage');
        }

        $authentificationUtils = $this->get('security.authentication_utils');

        return $this->render('DIUserBundle:Default:login.html.twig', array(
            'last_username' => $authentificationUtils->getLastUsername(),
            'error' => $authentificationUtils->getLastAuthenticationError()
        ));

    }

}
