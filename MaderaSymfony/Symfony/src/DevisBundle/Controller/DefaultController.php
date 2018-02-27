<?php

namespace DevisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DevisBundle\Entity\Modele;
use DevisBundle\Entity\Gamme;
use DevisBundle\Entity\Utilisateur;
use DevisBundle\Entity\Image;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $modeles = $this->GetModeles();
        $array = array();
        $arrayTemp = array();
        $i = 0;
        foreach($modeles as $model){
            $id = $model->getId();
            $arrayTemp[0] = $model->getNom();
            $url = $model->getFkImage()[0];
            if($url != null)
                $arrayTemp[1] = $this->GetImage($url);
            $arrayTemp[2] = $this->getDoctrine()->getManager()->getRepository('DevisBundle:Gamme')->GetGamme($id);
            $array[$i] = $arrayTemp;
            $i++;
        }
        
        return $this->render('DevisBundle:Default:index.html.twig', array('repoGammes' => $array));
    }

    #region Ecran 1
    public function GetModeles(){
        $repoModeles = $this->getDoctrine()->getRepository(Modele::class);
        return $repoModeles->findAll();
    }

    public function GetGammes($id){
        var_dump($id);
        $repoGamme = $this->getDoctrine()->getRepository(Gamme::class);
        return $repoGamme->find($id);
    }

    public function GetImage($id){
        $repoImg = $this->getDoctrine()->getRepository(Image::class);
        return $repoImg->find($id);
    }
    #endregion

    #region Generation BDD
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
        $test = $this->SetUtilisateur("Jules", "Ragot", "jules@ragot.fr", "0666666666", "0232542334", "Jules", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Pierre", "Thiebert", "pierre@thiebert.fr", "0666666666", "0232542334", "Pierre", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Thomas", "Lepretre", "Thomas@lepretre.fr", "0666666666", "0232542334", "Thomas", md5("1234"), 1, 1);

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
    #endregion
}
