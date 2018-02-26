<?php

namespace DevisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DevisBundle\Entity;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $test = $this->GenerateBDD();
        return $this->render('DevisBundle:Default:index.html.twig');
    }

    public function GenerateBDD(){
        $test = $this->SetModele();
    }

    public function SetModele(){
        $m = new Modele();
        $m->setNom("Maison Ville");
        $em = $this->getDoctrine()->getManager();
        $em->persist($m);
        $em->flush();
    }
}
