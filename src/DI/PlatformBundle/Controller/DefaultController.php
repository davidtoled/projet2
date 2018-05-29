<?php

namespace DI\PlatformBundle\Controller;

use DI\PlatformBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $listAdverts = array(
            array('id' => 1, 'title' => 'Recherche developper Symfony', 'author' => 'Adrien', 'date' => new \Datetime()),
            array('id' => 2, 'title' => 'Freelance front-end', 'author' => 'Adrien', 'date' => new \Datetime()),
            array('id' => 3, 'title' => 'Recherche teacher-assistant', 'author' => 'Adrien', 'date' => new \Datetime()),
            array('id' => 4, 'title' => 'Stagiaire en Informatique', 'author' => 'Adrien', 'date' => new \Datetime()),
            array('id' => 5, 'title' => 'Developpeur PHP', 'author' => 'Adrien', 'date' => new \Datetime()),
            array('id' => 6, 'title' => 'Recherche professeur chez Developpers Institute', 'author' => 'Adrien', 'date' => new \Datetime())
        );

        return $this->render('DIPlatformBundle:Advert:index.html.twig', array('listadverts' => $listAdverts));
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

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $advert = $em->getRepository('DIPlatformBundle:Advert')->find($id);

        return $this->render('DIPlatformBundle:Advert:view.html.twig',
            array('advert' => $advert));

    }

    public function menuAction() {

        $listAdverts = array(
            array('id' => 1, 'title' => 'Recherche developper Symfony'),
            array('id' => 2, 'title' => 'Freelance front-end'),
            array('id' => 3, 'title' => 'Recherche teacher-assistant'),
        );

        return $this->render('DIPlatformBundle:Advert:menu.html.twig', array('listadverts' => $listAdverts));

    }

    public function editAction($id) {
        return $this->render('DIPlatformBundle:Advert:edit.html.twig',
            array('idannonce' => $id));
    }

    public function deleteAction() {
        return $this->render('DIPlatformBundle:Advert:index.html.twig');
    }


}
