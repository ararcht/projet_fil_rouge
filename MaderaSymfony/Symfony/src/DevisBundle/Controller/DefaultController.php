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
          // var_dump($result);
      //   $repository = $this
      //     ->getDoctrine()
      //     ->getManager()
      //     ->getRepository('DevisBundle:Utilisateur')
      //   ;
      //
      // $ListModele = $repository->findAll();

      $user = $this->getUtilisateur(1);

      $nom = $user->getNom();

        //$nom = $user->getNom();

        return $this->render('DevisBundle:Default:index.html.twig', array('modeles' => $result, 'username' => $nom));
    }

    /**
     * @Route("/results")
     */
    public function resultsAction()
    {
         // $this->GenerateBDD();
        // $arrayModeleGamme = $this->getModeleGamme();
        $user = $this->getUtilisateur(1);
        $nom = $user->getNom();
        $data = $this->getEtape2("Maison Ville", "Basique");
        var_dump($data);
        return $this->render('DevisBundle:Default:results.html.twig', array('results' => $data, 'username' => $nom));
    }

    #region Ecran Index
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
            // $url = $model->getFkImage()[0];
            // if($url != null){
            //     $arrayTemp[1] = $this->GetImage($url);
            // }
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

    #region etape 2
    public function getEtape2($modele, $gamme){
        $objReturn = [];
        $m = $this->getIdModele($modele);
        $g = $this->getIdGamme($gamme);
        $objReturn["Modele"] = $modele;
        $objReturn["Gamme"] = $gamme;
        $objReturn["Module"] = [];

        #region repo
        $repository = $this
         ->getDoctrine()
         ->getManager()
         ->getRepository('DevisBundle:Module')
       ;

       $repositoryCompo = $this
         ->getDoctrine()
         ->getManager()
         ->getRepository('DevisBundle:Composant')
       ;

       $repositoryMatiere = $this
         ->getDoctrine()
         ->getManager()
         ->getRepository('DevisBundle:Matiere')
       ;

       $repositoryTeinte = $this
         ->getDoctrine()
         ->getManager()
         ->getRepository('DevisBundle:Teinte')
       ;
       #endregion
        $i = 0;
        $module = $repository->findBy(['fk_gamme' => $g]);
        foreach($module as $val){
            $objReturn["Module"][$i]["Nom"] = $val->nom;
            $compo = $repositoryCompo->findBy(['fk_module' => $val]);
            foreach($compo as $c){
                $objReturn["Module"][$i]["Composant"]["Nom"] = $c->nom;
                $objReturn["Module"][$i]["Composant"]["Prix"] = $c->prix;
                $n = $this->getCompoRef($c);
                $matiere = $repositoryMatiere->findBy(['fk_composant' => $n]);
                $j=0;
                foreach($matiere as $m){
                    $objReturn["Module"][$i]["Composant"]["Matiere"][$j] = $m->matiere;
                    $j++;
                }
                $teinte = $repositoryTeinte->findBy(['fk_composant' => $n]);
                $j=0;
                foreach($teinte as $t){
                    $objReturn["Module"][$i]["Composant"]["Teinte"][$j] = $t->description;
                    $j++;
                }
            }
            $i++;
        }
        var_dump($objReturn);
        return $objReturn;
    }


    public function getIdModele($nom){
        return $this->getDoctrine()->getRepository(Modele::class)->findOneBy(['nom' => $nom]);
    }

    public function getIdGamme($nom){
        return $this->getDoctrine()->getRepository(Gamme::class)->findOneBy(['nom' => $nom]);
    }

    public function getCompoRef($c){
        switch($c->nom){
            case "Porte":
                return 1;
            case "Fenêtre":
                return 2;
            case "Sol":
                return 3;
            case "Toiture":
                return 4;
        }
    }
    #endregion

}
