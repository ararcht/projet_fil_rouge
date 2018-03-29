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
        // $this->GenerateBDD();
        $arrayModeleGamme = $this->getModeleGamme();
        $result = $this->GetArray();
          var_dump($result);
      //   $repository = $this
      //     ->getDoctrine()
      //     ->getManager()
      //     ->getRepository('DevisBundle:Utilisateur')
      //   ;
      //
      // $ListModele = $repository->findAll();

      $user = $this->getUtilisateur(1);

      $nom = $user->getNom();

        return $this->render('DevisBundle:Default:index.html.twig', array('modeles' => $result, 'username' => $nom));
    }
    public function resultsAction()
    {
        // $this->GenerateBDD();
        // $arrayModeleGamme = $this->getModeleGamme();

        return $this->render('DevisBundle:Default:results.html.twig');
    }

    // public function menuAction(){
    //   $user = $this->getUtilisateur(1);
    //
    //   $nom = $user->getNom();
    //
    //   var_dump($nom);
    //
    //   return $this->render('DevisBundle:Default:menu.html.twig', array('username' => $nom));
    //
    // }

    #region Ecran 1
    public function GetModeles(){
        $repoModeles = $this->getDoctrine()->getRepository(Modele::class);
        return $repoModeles->findAll();
    }

    public function GetGammes($id){
        $repoGamme = $this->getDoctrine()->getRepository(Gamme::class);
        return $repoGamme->find($id);
    }

    public function GetUtilisateur($id){
     $repository = $this
         ->getDoctrine()
         ->getManager()
         ->getRepository('DevisBundle:Utilisateur')
       ;

     $user = $repository->find($id);
     return $user;
   }


    public function GetImage($id){
        $repoImg = $this->getDoctrine()->getRepository(Image::class);
        return $repoImg->find($id);
    }

    public function getModeleGamme(){
        $modeles = $this->GetModeles();
        $array = array();
        $arrayTemp = array();
        $i = 0;
        foreach($modeles as $model){
            $id = $model->getId();
            $arrayTemp[0] = $model->getNom();
            $url = $model->getFkImage()[0];
            if($url != null){
                $arrayTemp[1] = $this->GetImage($url);
            }
            // var_dump($id);
            $arrayTemp[2] = $this->getDoctrine()->getManager()->getRepository('DevisBundle:Gamme')->GetGamme($id);
            // var_dump($arrayTemp[2]);
            $array[$i] = $arrayTemp;
            $i++;

        }
        // var_dump($array);
        return $array;
    }

    public function GetArray(){
        $all = $this->getModeleGamme();
        $tab = Array();
        $i = 0;
        $j = 0;

        foreach($all as $modele){
            $j = 0;
            $tab[$i]["nom"] = $modele[0];
            $tab[$i]['url'] = '';
            foreach($modele[2] as $data){
                $tab[$i]["gamme"][$j]= $data->getNom();
                $j++;
            }
            $i++;
        }
        return $tab;
    }
    #endregion


    #region Generation BDD
    public function GenerateBDD(){
        $test = $this->SetModele("Maison Ville", "1", null);
        $test = $this->SetModele("Maison Campagne", "1", null);
        $test = $this->SetGamme("Eco", "1", "3");
        $test = $this->SetGamme("Basique", "1", "3");
        $test = $this->SetGamme("Premium", "1", "3");
        $test = $this->SetGamme("Eco", "2", "3");
        $test = $this->SetGamme("Basique", "2", "3");
        $test = $this->SetUtilisateur("Alison", "Rarchaert", "alison@rarchaert.fr", "0666666666", "0232542334", "Alison", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Jules", "Ragot", "jules@ragot.fr", "0666666666", "0232542334", "Jules", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Pierre", "Thiebert", "pierre@thiebert.fr", "0666666666", "0232542334", "Pierre", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Thomas", "Lepretre", "Thomas@lepretre.fr", "0666666666", "0232542334", "Thomas", md5("1234"), 1, 1);

    }

    public function SetModele($name, $idModule, $devis){
        $m = new Modele();
        $m->setNom($name);
        $m->setFkModule($idModule);
        $m->setFkDevis($devis);
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
