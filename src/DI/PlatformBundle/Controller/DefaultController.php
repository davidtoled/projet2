<?php

namespace DI\PlatformBundle\Controller;

use DI\PlatformBundle\Entity\Advert;
use DI\PlatformBundle\Entity\Application;
use DI\PlatformBundle\Entity\Image;
use DI\PlatformBundle\Entity\User;
use DI\PlatformBundle\Form\AdvertEditType;
use DI\PlatformBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    public function indexAction($page, Request $request)
    {

        /*
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas");
        }
        */

        $query = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('DIPlatformBundle:Advert')
                            ->myFindAll();
                            //->myFindOne(2);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', $page),
            10/*limit per page*/
        );

        return $this->render('DIPlatformBundle:Advert:index.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request) {

        $advert = new Advert();

        $form = $this->get('form.factory')->create(AdvertType::class, $advert);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $advert->setNbApplications(0);

                $advert->getImage()->upload();

                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();

                $translator = $this->get('translator');
                $messagesuccess = $translator->trans('save.ok');
                $this->addFlash('success', $messagesuccess);

                return $this->redirectToRoute('di_platform_view', array('id' => $advert->getId()));
            }

        }




        //return new Response('Voici mon formulaire pour créer une annonce');
        return $this->render('DIPlatformBundle:Advert:add.html.twig',
            array('formulaire' => $form->createView())
        );
    }

    public function viewAction(Advert $advert) {

        $em = $this->getDoctrine()->getManager();
        //$advert = $em->getRepository('DIPlatformBundle:Advert')->find($id);

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

        $form = $this->get('form.factory')->create(AdvertEditType::class, $advert);

        /*
        foreach ($list_categories as $category) {
            $advert->addCategory($category);
        }
        */

        //$em->flush();

        return $this->render('DIPlatformBundle:Advert:edit.html.twig',
            array('advert' => $advert, 'list_applications'=>$list_applications,
                'list_categories'=>$list_categories, 'formulaire' => $form->createView()));
    }

    public function deleteAction(Advert $advert) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($advert);
        $em->flush();

        $this->addFlash('success', 'Annonce bien supprimée');

        return $this->redirectToRoute('di_platform_homepage');
    }


}
