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
        //$this->GenerateBDD();
<<<<<<< HEAD
        // $arrayModeleGamme = $this->getModeleGamme();
        // $result = $this->GetArray();
        // //   $repository = $this
        // //     ->getDoctrine()
        // //     ->getManager()
        // //     ->getRepository('DevisBundle:Utilisateur')
        // //   ;
        // //
        // // $ListModele = $repository->findAll();

        // $user = $this->getUtilisateur(1);

        //$nom = $user->getNom();
        var_dump($this->getEtape2("Maison Ville", "Basique"));
=======
        $arrayModeleGamme = $this->getModeleGamme();
        $result = $this->GetArray();
      //    var_dump($result);
      //   $repository = $this
      //     ->getDoctrine()
      //     ->getManager()
      //     ->getRepository('DevisBundle:Utilisateur')
      //   ;
      //
      // $ListModele = $repository->findAll();

      $user = $this->getUtilisateur(1);

      $nom = $user->getNom();
        // var_dump($result);
>>>>>>> e7f8582c0e4c69e84881bf2dc97484b010dd03cd
        return $this->render('DevisBundle:Default:index.html.twig', array('modeles' => $result, 'username' => $nom));

    }

    /**
     * @Route("/results")
     */

     public function resultsAction(){
       $user = $this->getUtilisateur(1);

       $nom = $user->getNom();
       return $this->render('DevisBundle:Default:results.html.twig',array('username' => $nom));
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
        #region modele
        $test = $this->SetModele("Maison Ville", "1", null);
        $test = $this->SetModele("Maison Campagne", "1", null);
<<<<<<< HEAD
        $test = $this->SetModele("Maison Ecologique", "1", null);
        $test = $this->SetModele("Maison Moderne", "1", null);
        #endregion
        
        #region gamme
        $test = $this->SetGamme("Eco", "1", "3");//1
        $test = $this->SetGamme("Basique", "1", "3");//2
        $test = $this->SetGamme("Eco", "2", "3");//3
        $test = $this->SetGamme("Basique", "2", "3");//4
        $test = $this->SetGamme("Eco", "3", "3");//5
        $test = $this->SetGamme("Basique", "3", "3");//6
        $test = $this->SetGamme("Premium", "3", "3");//7
        $test = $this->SetGamme("Eco", "4", "3");//8
        $test = $this->SetGamme("Basique", "4", "3");//9
        $test = $this->SetGamme("Premium", "4", "3");//10
        #endregion
        
        #region user
=======
        $test = $this->SetGamme("Eco", "1", "3");
        $test = $this->SetGamme("Basique", "1", "3");
        $test = $this->SetGamme("Eco", "2", "3");
        $test = $this->SetGamme("Basique", "2", "3");
        $test = $this->SetGamme("Eco", "3", "3");
        $test = $this->SetGamme("Basique", "3", "3");
        $test = $this->SetGamme("Premium", "3", "3");
        $test = $this->SetGamme("Eco", "4", "3");
        $test = $this->SetGamme("Basique", "4", "3");
        $test = $this->SetGamme("Premium", "4", "3");

>>>>>>> e7f8582c0e4c69e84881bf2dc97484b010dd03cd
        $test = $this->SetUtilisateur("Alison", "Rarchaert", "alison@rarchaert.fr", "0666666666", "0232542334", "Alison", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Jules", "Ragot", "jules@ragot.pro", "0666666666", "0232542334", "Jules", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Pierre", "Thiebert", "pierre@thiebert.me", "0666666666", "0232542334", "Pierre", md5("1234"), 1, 1);
        $test = $this->SetUtilisateur("Thomas", "Lepretre", "Thomas@lepretre.fr", "0666666666", "0232542334", "Thomas", md5("1234"), 1, 1);
        #endregion
        
        #region matiere
        //Fenetre = 1
        $this->setMatiere("PVC",1);
        $this->setMatiere("Aluminium",1);
        $this->setMatiere("Bois",1);
        
        //Porte = 2
        $this->setMatiere("PVC",2);
        $this->setMatiere("Bois",1);
        $this->setMatiere("Verre",1);
        

        //Sol = 3
        $this->setMatiere("Parquet",3);
        $this->setMatiere("Stratifie",3);
        $this->setMatiere("Carrelage",3);
        $this->setMatiere("Lino",3);
        
        //Toiture = 4
        $this->setMatiere("Tuile",4);
        $this->setMatiere("Ardoise",4);
        $this->setMatiere("Chaume",4);        
        #endregion
        
        #region Teinte
        //Fenetre = 1
        $this->SetTeinte("1","Bois",1);
        $this->SetTeinte("1","Blanc",1);
        $this->SetTeinte("1","Naturelle",1);
        
        //Porte = 2
        $this->SetTeinte("1","Bois",2);
        $this->SetTeinte("1","Blanc",2);
        $this->SetTeinte("1","Noir",2);
        $this->SetTeinte("1","Naturelle",2);
        
        //Sol = 3
        $this->SetTeinte("1","Bois", 3);
        $this->SetTeinte("1","Gris",3);
        $this->SetTeinte("1","Blanc",3);
        $this->SetTeinte("1","Noir",3);

        //Toiture = 4
        $this->SetTeinte("1","Naturelle",4);
        
        #endregion

        #region fenetre
        $this->SetComposant("Fenêtre", 100, 150,0,20,763, 150,1,1,1,9,7);//1
        $this->SetComposant("Fenêtre", 100, 150,0,20,763, 200,2,1,2,6,5);//2
        $this->SetComposant("Fenêtre", 100, 150,0,22,493, 350,3,1,3,7,6);//3
        $this->SetComposant("Fenêtre", 100, 150,0,22,493, 350,3,1,4,7,6);//4
        $this->SetComposant("Fenêtre", 100, 150,0,22,493, 350,3,1,5,7,6);//5
        $this->SetComposant("Fenêtre", 100, 150,0,22,493, 350,3,1,6,7,6);//6
        $this->SetComposant("Fenêtre", 100, 150,0,22,493, 350,3,1,7,7,6);//7
        $this->SetComposant("Fenêtre", 100, 150,0,22,493, 350,3,1,8,7,6);//8
        $this->SetComposant("Fenêtre", 100, 150,0,22,493, 350,3,1,9,7,6);//9
        $this->SetComposant("Fenêtre", 100, 150,0,22,493, 350,3,1,10,7,6);//10
        $this->SetComposant("Fenêtre", 100, 150,0,22,493, 350,3,1,11,7,6);//11
        #endregion
        
        #region Porte
        $this->SetComposant("Porte", 200, 90,0,15,800, 40,1,1,1,9,7);//12
        $this->SetComposant("Porte", 200, 90,0,15,850, 60,2,1,2,6,5);//13
        $this->SetComposant("Porte", 200, 90,0,15,850, 80,3,1,3,7,6);//14
        $this->SetComposant("Porte", 200, 90,0,15,850, 80,3,1,4,7,6);//15
        $this->SetComposant("Porte", 200, 90,0,15,850, 80,3,1,5,7,6);//16
        $this->SetComposant("Porte", 200, 90,0,15,850, 80,3,1,6,7,6);//17
        $this->SetComposant("Porte", 200, 90,0,15,850, 80,3,1,7,7,6);//18
        $this->SetComposant("Porte", 200, 90,0,15,850, 80,3,1,8,7,6);//19
        $this->SetComposant("Porte", 200, 90,0,15,850, 80,3,1,9,7,6);//20
        $this->SetComposant("Porte", 200, 90,0,15,850, 80,3,1,10,7,6);//21
        $this->SetComposant("Porte", 200, 90,0,15,850, 80,3,1,11,7,6);//22
        #endregion
        
        #region Sol
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,23,6,7);//23
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,24,6,7);//24
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,25,6,7);//25
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,26,6,7);//26
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,27,6,7);//27
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,28,6,7);//28
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,29,6,7);//29
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,30,6,7);//30
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,31,6,7);//31
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,32,6,7);//32
        $this->SetComposant("Sol", 0, 0, 80, 1 ,10000, 800,1,1,33,6,7);//33
        #endregion
       
        #region Toiture
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,12,6,7);//23
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,13,6,7);//24
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,14,6,7);//25
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,15,6,7);//26
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,16,6,7);//27
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,17,6,7);//28
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,18,6,7);//29
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,19,6,7);//30
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,20,6,7);//31
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,21,6,7);//32
        $this->SetComposant("Toiture", 0, 0, 80, 1 ,100000, 800,1,1,22,6,7);//33
        #endregion

        #region mur
        $this->setModule("Mur",5000,0,0,1,1);//1
        $this->setModule("Mur",5000,0,0,2,1);//2
        $this->setModule("Mur",5000,0,0,3,1);//3
        $this->setModule("Mur",5000,0,0,4,1);//4
        $this->setModule("Mur",5000,0,0,5,1);//5
        $this->setModule("Mur",5000,0,0,6,1);//6
        $this->setModule("Mur",5000,0,0,7,1);//7
        $this->setModule("Mur",5000,0,0,8,1);//8
        $this->setModule("Mur",5000,0,0,9,1);//9
        $this->setModule("Mur",5000,0,0,10,1);//10
        $this->setModule("Mur",5000,0,0,11,1);//11
        #endregion
        
        #region toiture
        $this->setModule("Toiture",10000,0,0,1,0);//12
        $this->setModule("Toiture",10000,0,0,2,0);//13
        $this->setModule("Toiture",10000,0,0,3,0);//14
        $this->setModule("Toiture",10000,0,0,4,0);//15
        $this->setModule("Toiture",10000,0,0,5,0);//16
        $this->setModule("Toiture",10000,0,0,6,0);//17
        $this->setModule("Toiture",10000,0,0,7,0);//18
        $this->setModule("Toiture",10000,0,0,8,0);//19
        $this->setModule("Toiture",10000,0,0,9,0);//20
        $this->setModule("Toiture",10000,0,0,10,0);//21
        $this->setModule("Toiture",10000,0,0,11,0);//22
        #endregion
        
        #region sol
<<<<<<< HEAD
        $this->setModule("Sol",10000,0,0,1,0);//23        
        $this->setModule("Sol",10000,0,0,2,0);//24        
        $this->setModule("Sol",10000,0,0,3,0);//25    
        $this->setModule("Sol",10000,0,0,4,0);//26
        $this->setModule("Sol",10000,0,0,5,0);//27      
        $this->setModule("Sol",10000,0,0,6,0);//28      
        $this->setModule("Sol",10000,0,0,7,0);//29      
        $this->setModule("Sol",10000,0,0,8,0);//30      
        $this->setModule("Sol",10000,0,0,9,0);//31      
        $this->setModule("Sol",10000,0,0,10,0);//32       
        $this->setModule("Sol",10000,0,0,11,0);//33
=======
        $this->setModule("Sol",10000,0,0,1,0);
        $this->setModule("Sol",10000,0,0,2,0);
        $this->setModule("Sol",10000,0,0,3,0);
        $this->setModule("Sol",10000,0,0,4,0);
        $this->setModule("Sol",10000,0,0,5,0);
        $this->setModule("Sol",10000,0,0,6,0);
        $this->setModule("Sol",10000,0,0,7,0);
        $this->setModule("Sol",10000,0,0,8,0);
        $this->setModule("Sol",10000,0,0,9,0);
        $this->setModule("Sol",10000,0,0,10,0);
        $this->setModule("Sol",10000,0,0,11,0);
>>>>>>> e7f8582c0e4c69e84881bf2dc97484b010dd03cd
        #endregion
        
        #region cloison
        $this->setModule("Cloison",1000,0,0,1,0);
        $this->setModule("Cloison",1000,0,0,3,0);
        $this->setModule("Cloison",1000,0,0,2,0);
        $this->setModule("Cloison",1000,0,0,4,0);
        $this->setModule("Cloison",1000,0,0,5,0);
        $this->setModule("Cloison",1000,0,0,6,0);
        $this->setModule("Cloison",1000,0,0,7,0);
        $this->setModule("Cloison",1000,0,0,8,0);
        $this->setModule("Cloison",1000,0,0,9,0);
        $this->setModule("Cloison",1000,0,0,10,0);
        $this->setModule("Cloison",1000,0,0,11,0);
        #endregion

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
<<<<<<< HEAD

    #region etape 2
    public function getEtape2($modele, $gamme){
        $objReturn = [];
        $m = $this->getIdModele($modele);
        $g = $this->getIdGamme($g);
        $objReturn["Modele"] = $m->Nom;
        $objReturn["Gamme"] = $g->Nom;
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
        $module = $repository->findBy(['Gamme' => $g]);
        foreach($module as $val){
            $objReturn["Module"][$i]["Nom"] = $compo->Nom;
            $compo = $repositoryCompo->findBy(['Module' => $val]);
            foreach($compo as $c){
                $objReturn["Module"][$i]["Composant"]["Nom"] = $c->Nom;
                $objReturn["Module"][$i]["Composant"]["Prix"] = $c->Prix;
                $n = $this->getCompoRef($c);
                $matiere = $repositoryMatiere->findBy(['Composant' => $n]);
                $j=0;
                foreach($matiere as $m){
                    $objReturn["Module"][$i]["Composant"]["Matiere"][$j] = $m->Matiere;
                    $j++;
                }
                $teinte = $repositoryTeinte->findBy(['Composant' => $n]);
                $j=0;
                foreach($teinte as $t){
                    $objReturn["Module"][$i]["Composant"]["Teinte"][$j] = $t->Description;
                    $j++;
                }
            }
            $i++;
        }
        return $objReturn;
    }


    public function getIdModele($nom){
        $repoModele = $this->getDoctrine()->getRepository(Modele::class)->find(1);
        
        var_dump($repoModele);
        // $truc = $repoModele->findById(1);
        var_dump($truc);
    }

    public function getIdGamme($nom){
        $repository = $this
         ->getDoctrine()
         ->getManager()
         ->getRepository('DevisBundle:Gamme')
       ;
       return $repository->findBy(['Nom' => $nom])->Id;
    }

    public function getCompoRef($c){
        switch($c->Nom){
            case "Porte":
                return 1;
            case "Fenetre":
                return 2;
            case "Sol":
                return 3;  
            case "Toiture":
                return 4;
        }
    }
    #endregion

=======
>>>>>>> e7f8582c0e4c69e84881bf2dc97484b010dd03cd
}
