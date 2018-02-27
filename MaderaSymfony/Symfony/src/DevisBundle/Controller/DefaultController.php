<?php

namespace DevisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DevisBundle\Entity\Modele;
use DevisBundle\Entity\Gamme;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        // $test = $this->GenerateBDD();
        $repoGamme = $this->getDoctrine()->getRepository(Gamme::class);
        $modeles = $repoGamme->GetGamme('1');
        var_dump($modeles);
        return $this->render('DevisBundle:Default:index.html.twig');
    }

    public function GenerateBDD(){
        $test = $this->SetModele("Maison Ville", "1", null, "1");
        $test = $this->SetModele("Maison Ville", "1", null, "2");
        $test = $this->SetModele("Maison Ville", "1", null, "3");
        $test = $this->SetModele("Maison Campagne", "1", null, "1");
        $test = $this->SetModele("Maison Campagne", "1", null, "2");
        $test = $this->SetModele("Maison Campagne", "1", null, "3");
        $test = $this->SetGamme("Eco", "1", "3");
        $test = $this->SetGamme("Basique", "1", "3");
        $test = $this->SetGamme("Premium", "1", "3");
    }

    public function SetModele($name, $idModule, $devis, $gamme){
        $m = new Modele();
        $m->setNom($name);
        $m->setFkModule($idModule);
        $m->setFkDevis($devis);
        $m->setFkGamme($gamme);
        $em = $this->getDoctrine()->getManager();
        $em->persist($m);
        $em->flush();
    }

    public function SetGamme($name, $idModele, $idComposant){
        $m = new Gamme();
        $m->setNom($name);
        $m->setFkModele($idModele);
        $m->setFkComposant($idComposant);
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
