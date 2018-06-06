<?php

namespace DI\PlatformBundle\Controller;

use DI\PlatformBundle\Entity\Advert;
use DI\PlatformBundle\Entity\Application;
use DI\PlatformBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /*
        $listAdverts = array(
            array('id' => 1, 'title' => 'Recherche developper Symfony', 'author' => 'Adrien', 'date' => new \Datetime()),
            array('id' => 2, 'title' => 'Freelance front-end', 'author' => 'Adrien', 'date' => new \Datetime()),
            array('id' => 3, 'title' => 'Recherche teacher-assistant', 'author' => 'Adrien', 'date' => new \Datetime()),
            array('id' => 4, 'title' => 'Stagiaire en Informatique', 'author' => 'Adrien', 'date' => new \Datetime()),
            array('id' => 5, 'title' => 'Developpeur PHP', 'author' => 'Adrien', 'date' => new \Datetime()),
            array('id' => 6, 'title' => 'Recherche professeur chez Developpers Institute', 'author' => 'Adrien', 'date' => new \Datetime())
        );
        */
        $listAdverts = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('DIPlatformBundle:Advert')
                            ->findAll();
                            //->myFindAll();
                            //->myFindOne(2);


        return $this->render('DIPlatformBundle:Advert:index.html.twig', array('listadverts' => $listAdverts));
    }

    public function addAction() {

        $advert = new Advert();
        $advert->setTitle('Test avec Dina');
        $advert->setAuthor('rebibo.adrien@gmail.com');
        $advert->setContent('Vive Dina');
        $advert->setDate(new \DateTime());

        $image = new Image();
        $image->setUrl('https://thumbs.dreamstime.com/z/magen-david-%C3%A9cran-protecteur-de-david-15292440.jpg');
        $image->setAlt('magen David');

        $application1 = new Application();
        $application1->setDate(new \Datetime());
        $application1->setAuthor('Toto');
        $application1->setContent('Je suis hyper motivé');
        $application1->setAdvert($advert);

        $application2 = new Application();
        $application2->setDate(new \Datetime());
        $application2->setAuthor('greenbergyoel@gmail.com');
        $application2->setContent('Je suis le plus fort');
        $application2->setAdvert($advert);

        $advert->setImage($image);

        $em = $this->getDoctrine()->getManager();

        $em->persist($advert);
        $em->persist($application1);
        $em->persist($application2);
        $em->flush();

        //return new Response('Voici mon formulaire pour créer une annonce');
        return $this->render('DIPlatformBundle:Advert:add.html.twig',
            array("nomvariable1" => "contenuvariable 1",
                "nomvariable2" => "contenuvariable 2"
            )
        );
    }

    public function viewAction($id) {

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('DIPlatformBundle:Advert')->find($id);
        $list_applications = $em->getRepository('DIPlatformBundle:Application')->findByAdvert($advert);

        //$list_adverts = $em->getRepository('DIPlatformBundle:Advert')->getAdvertWithApplications($id);
/*
        foreach ($list_adverts as $advert) {
            $advert->getApplications();
        }
*/
        return $this->render('DIPlatformBundle:Advert:view.html.twig',
            array('advert' => $advert, 'list_applications' => $list_applications));

    }

    public function menuAction() {

        /*
        $listAdverts = array(
            array('id' => 1, 'title' => 'Recherche developper Symfony'),
            array('id' => 2, 'title' => 'Freelance front-end'),
            array('id' => 3, 'title' => 'Recherche teacher-assistant'),
        );
        */

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $listAdverts = $em->getRepository('DIPlatformBundle:Advert')->findBy(array(), array('date'=>'desc'), 2, 0);
        return $this->render('DIPlatformBundle:Advert:menu.html.twig', array('listadverts' => $listAdverts));

    }

    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('DIPlatformBundle:Advert')->find($id);
        $list_applications = $em->getRepository('DIPlatformBundle:Application')->findByAdvert($advert);
        $list_categories = $em->getRepository('DIPlatformBundle:Category')->findAll();

        foreach ($list_categories as $category) {
            $advert->addCategory($category);
        }

        $em->flush();

        return $this->render('DIPlatformBundle:Advert:edit.html.twig',
            array('advert' => $advert, 'list_applications'=>$list_applications,
                'list_categories'=>$list_categories));
    }

    public function deleteAction() {
        return $this->render('DIPlatformBundle:Advert:index.html.twig');
    }


}
