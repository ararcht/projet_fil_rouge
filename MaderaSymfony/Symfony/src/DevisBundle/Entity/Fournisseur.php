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
     * @var int
     * @ORM\Column(name="BonCommande", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\BonCommande", mappedBy="BonCommande")
     */
     private $fk_boncommande;

    /**
     * @var int
     * @ORM\Column(name="Composant", type="integer")
     * ORM\OneToOne(targetEntity="DevisBundle\Entity\Composant", cascade={"persist"})
     */
    private $fk_composant;

    /**
     * @var int
     * @ORM\Column(name="Utilisateur", type="integer")
     * ORM\OneToOne(targetEntity="DevisBundle\Entity\Utilisateur", cascade={"persist"})
     */
    private $fk_utilisateur;

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
     * Set fkBoncommande.
     *
     * @param int $fkBoncommande
     *
     * @return Fournisseur
     */
    public function setFkBoncommande($fkBoncommande)
    {
        $this->fk_boncommande = $fkBoncommande;

        return $this;
    }

    /**
     * Get fkBoncommande.
     *
     * @return int
     */
    public function getFkBoncommande()
    {
        return $this->fk_boncommande;
    }

    /**
     * Set fkComposant.
     *
     * @param int $fkComposant
     *
     * @return Fournisseur
     */
    public function setFkComposant($fkComposant)
    {
        $this->fk_composant = $fkComposant;

        return $this;
    }

    /**
     * Get fkComposant.
     *
     * @return int
     */
    public function getFkComposant()
    {
        return $this->fk_composant;
    }

    /**
     * Set fkUtilisateur.
     *
     * @param int $fkUtilisateur
     *
     * @return Fournisseur
     */
    public function setFkUtilisateur($fkUtilisateur)
    {
        $this->fk_utilisateur = $fkUtilisateur;

        return $this;
    }

    /**
     * Get fkUtilisateur.
     *
     * @return int
     */
    public function getFkUtilisateur()
    {
        return $this->fk_utilisateur;
    }
}
