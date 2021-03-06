<?php

namespace DevisBundle\Repository;
use DevisBundle\Entity\Modele;

/**
 * ModeleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ModeleRepository extends \Doctrine\ORM\EntityRepository
{
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
}
