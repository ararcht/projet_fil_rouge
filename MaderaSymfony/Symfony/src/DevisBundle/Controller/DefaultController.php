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
            $url = $model->getFkImage()[0];
            if($url != null){
                $arrayTemp[1] = $this->GetImage($url);
            }
            // var_dump($id);
            $arrayTemp[2] = $this->getDoctrine()->getManager()->getRepository('DevisBundle:Gamme')->GetGamme($id);
            $arrayTemp[3] = $id;
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
            foreach($modele[2] as $data){
                $tab[$i]["gamme".$j] = $data->getNom();
                $j++;
            }
            $tab[$i]["id"] = $modele[3];
            $i++;
        }
        return $tab;
    }
    #endregion


    #region Ecran Résultat
    public function SelectGamme($idGamme){

    }


    #endregion

    #region Generation BDD
    public function GenerateBDD(){
        $test = $this->SetModele("Maison Ville", "1", null);
        $test = $this->SetModele("Maison Campagne", "1", null);
        $test = $this->SetModele("Maison Ecologique", "1", null);
        $test = $this->SetModele("Maison Moderne", "1", null);

        $test = $this->SetGamme("Eco", "1", "3");
        $test = $this->SetGamme("Basique", "1", "3");
        $test = $this->SetGamme("Premium", "1", "3");

        $test = $this->SetUtilisateur("Alison", "Rarchaert", "alison@rarchaert.fr", "0666666666", "0232542334", "Alison", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Jules", "Ragot", "jules@ragot.fr", "0666666666", "0232542334", "Jules", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Pierre", "Thiebert", "pierre@thiebert.fr", "0666666666", "0232542334", "Pierre", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Thomas", "Lepretre", "Thomas@lepretre.fr", "0666666666", "0232542334", "Thomas", md5("1234"), 1, 1);

        $this->setMatiere("Chêne",1);
        $this->setMatiere("Sapin",1);
        $this->setMatiere("Hêtre",1);
        $this->setMatiere("Chaûme",1);
        $this->setMatiere("Ardoise",1);
        $this->setMatiere("PVC",1);
        $this->setMatiere("Alu",1);
        $this->setMatiere("Verre",1);
        $this->setMatiere("Bois",1);
        $this->setMatiere("Carrelage",1);


        $this->SetTeinte("1","Rouge",1);
        $this->SetTeinte("2","Bleu",1);
        $this->SetTeinte("3","Jaune",1);
        $this->SetTeinte("4","Vert",1);
        $this->SetTeinte("5","Blanc",1);
        $this->SetTeinte("6","Gris",1);
        $this->SetTeinte("7","Bois",1);



        $this->SetComposant("Fenêtre", 100, 150,0,20,763, 150,1,1,0,9,7);
        $this->SetComposant("Fenêtre", 100, 150,0,20,763, 200,2,1,0,6,5);
        $this->SetComposant("Fenêtre", 100, 150,0,22,493, 350,3,1,0,7,6);

        $this->SetComposant("Porte", 200, 90,0,15,800, 40,1,1,0,9,7);
        $this->SetComposant("Porte", 200, 90,0,15,850, 60,2,1,0,6,5);
        $this->SetComposant("Porte", 200, 90,0,15,850, 80,3,1,0,7,6);

        $this->SetComposant("Sol vinyle", 0, 0, 80, 1 ,10000, 800,1,1,0,6,7);
        $this->SetComposant("Sol Carrelage", 0, 0, 100, 1 ,10000, 3000,2,1,0,10,6);
        $this->SetComposant("Sol Parquet", 0, 0, 120, 1 ,10000, 12000,3,1,0,9,7);

        // //Toiture
        // $this->SetComposant("Sol Parquet", 0, 0, 120, 1, 10000, 12000,3,1,0,9,7);
        //
        //
        // //Mur avec porte
        // $this->setModule("Mur",5000,0,0,0,0);
        // $this->setModule("Toiture",10000,0,0,0,0);




// SetModule($nom, $prix, $composant, $typemodule, $devis, $gamme)



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

    public function SetModule($nom, $prix, $composant, $typemodule, $devis, $gamme){
        $m = new Module();
        $m->setNom($nom);
        $m->setPrix($prix);
        $m->setFkComposant($composant);
        $m->setFkTypeModule($typemodule);
        $m->setFkDevis($devis);
        $m->setFkGamme($gamme);
        $em = $this->getDoctrine()->getManager();
        $em->persist($m);
        $em->flush();
    }

    public function SetComposant($nom, $longueur, $largeur, $taille, $poids, $stock, $prix, $gamme, $fournisseur, $module, $matiere, $teinte){
        $m = new Module();
        $m->setNom($nom);
        $m->setLongueur($longueur);
        $m->setLargeur($largeur);
        $m->setTaille($taille);
        $m->setPoids($poids);
        $m->setStock($stock);
        $m->setPrix($prix);
        $m->setFkGamme($gamme);
        $m->setFkFournisseur($fournisseur);
        $m->setFkModule($module);
        $m->setFkMatiere($matiere);
        $m->setFkTeinte($teinte);
        $em = $this->getDoctrine()->getManager();
        $em->persist($m);
        $em->flush();
    }

    public function SetTeinte($codeTeinte, $description, $fk_composant){
        $m = new Teinte();
        $m->setCodeTeinte($codeTeinte);
        $m->setDescription($description);
        $m->setFkComposant($fk_composant);
        $em = $this->getDoctrine()->getManager();
        $em->persist($m);
        $em->flush();
    }

    public function SetMatiere($matiere, $fk_composant){
        $m = new Matiere();
        $m->setMatiere($matiere);
        $m->setFkComposant($fk_composant);
        $em = $this->getDoctrine()->getManager();
        $em->persist($m);
        $em->flush();
    }
    #endregion

}
