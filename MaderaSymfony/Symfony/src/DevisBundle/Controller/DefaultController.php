<?php

namespace DevisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DevisBundle\Entity\Modele;
use DevisBundle\Entity\Gamme;
use DevisBundle\Entity\Utilisateur;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $test = $this->GenerateBDD();
        // $repoGamme = $this->getDoctrine()->getRepository(Gamme::class);
        // $modeles = $repoGamme->GetGamme('1');
        // var_dump($modeles);
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
        $test = $this->SetUtilisateur("Alison", "Rarchaert", "alison@rarchaert.fr", "0666666666", "0232542334", "Alison", md5("1234"), 1, 1);

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

    public function SetUtilisateur($lastname, $name, $mail, $num, $homenum, $login, $mdp, $actif, $usertype){
        $m = new Utilisateur();
        $m->setNom($lastname);
        $m->setPrenom($name);
        $m->setMail($mail);
        $m->setNumPortable($num);
        $m->setNumFixe($homenum);
        $m->setLogin($login);
        $m->setMdp($mdp);
        $m->setActif($actif);
        $m->setUserType($usertype);
        $em = $this->getDoctrine()->getManager();
        $em->persist($m);
        $em->flush();
    }



    public function viewModele(){
        $repoModele = $this->getDoctrine()->getRepository(Modele::class);
        $repoGamme = $this->getDoctrine()->getRepository(Gamme::class);
        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $modeles = $repoModele->findAll();
        $gammes = $repoGamme->findAll();


    }
}
