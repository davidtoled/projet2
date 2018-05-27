<?php

namespace DI\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DIPlatformBundle:Advert:index.html.twig');
    }

    public function addAction() {
        //return new Response('Voici mon formulaire pour créer une annonce');
        return $this->render('DIPlatformBundle:Advert:add.html.twig',
            array("nomvariable1" => "contenuvariable 1",
                "nomvariable2" => "contenuvariable 2"
            )
        );
    }

    public function viewAction($id) {

        return $this->render('DIPlatformBundle:Advert:view.html.twig',
            array('idannonce' => $id));

    }

    public function menuAction() {

        $listAdverts = array(
            array('id' => 1, 'title' => 'Recherche developper Symfony'),
            array('id' => 2, 'title' => 'Freelance front-end'),
            array('id' => 3, 'title' => 'Recherche teacher-assistant'),
        );

        return $this->render('DIPlatformBundle:Advert:menu.html.twig', array('listadverts' => $listAdverts));

    }


}
