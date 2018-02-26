<?php

namespace DevisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DevisBundle\Entity\Modele;
<<<<<<< HEAD
=======
use DevisBundle\Entity\Gamme;
>>>>>>> fc1bd23cef48a3f20f7ed28d9a5c55310e92e71e

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

    public function viewModele(){
        $repoModele = $this->getDoctrine()->getRepository(Modele::class);
        $repoGamme = $this->getDoctrine()->getRepository(Gamme::class);
        $modeles = $repoModele->findAll();
        $gammes = $repoGamme->findAll();

        
    }
}
