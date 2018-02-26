<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\FournisseurRepository")
 */
class Fournisseur
{
    /**
     * @ORM\Column(name="Utilisateur",type="integer")
     * @ORM\ManyToOne(targetEntity="DevisBundle\Entity\Utilisateur")
     */
     private $fk_utilisateur;

     public function setUtilisateur(UserType $fk_utilisateur)
     {
       $this->fk_utilisateur = $fk_utilisateur;
       return $this;
     }

     public function getUtilisateur()
     {
       return $this->fk_utilisateur;
     }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="Prix", type="integer")
     */
    private $prix;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set prix.
     *
     * @param int $prix
     *
     * @return Fournisseur
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix.
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }
}
