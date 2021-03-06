<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Commande", type="datetime")
     */
    private $dateCommande;

    /**
     * @var string
     *
     * @ORM\Column(name="Reference", type="string", length=255)
     */
    private $reference;


    /**
     * @ORM\Column(name="Devis", type="integer")
     * @ORM\OneToOne(targetEntity="DevisBundle\Entity\Devis", cascade={"persist"})
     */
    private $fk_devis;


    /**
     * @var int
     * @ORM\Column(name="Paiement", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Paiement", mappedBy="Commande")
     */
    private $fk_Paiement;

    /**
     * @var int
     * @ORM\Column(name="Etat", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Etat", mappedBy="Commande")
     */
    private $fk_Etat;


    


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
     * Set dateCommande.
     *
     * @param \DateTime $dateCommande
     *
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande.
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set reference.
     *
     * @param string $reference
     *
     * @return Commande
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }



    /**
     * Set fkDevis.
     *
     * @param int $fkDevis
     *
     * @return Commande
     */
    public function setFkDevis($fkDevis)
    {
        $this->fk_devis = $fkDevis;

        return $this;
    }

    /**
     * Get fkDevis.
     *
     * @return int
     */
    public function getFkDevis()
    {
        return $this->fk_devis;
    }

    /**
     * Set fkPaiement.
     *
     * @param int $fkPaiement
     *
     * @return Commande
     */
    public function setFkPaiement($fkPaiement)
    {
        $this->fk_Paiement = $fkPaiement;

        return $this;
    }

    /**
     * Get fkPaiement.
     *
     * @return int
     */
    public function getFkPaiement()
    {
        return $this->fk_Paiement;
    }

    /**
     * Set fkEtat.
     *
     * @param int $fkEtat
     *
     * @return Commande
     */
    public function setFkEtat($fkEtat)
    {
        $this->fk_Etat = $fkEtat;

        return $this;
    }

    /**
     * Get fkEtat.
     *
     * @return int
     */
    public function getFkEtat()
    {
        return $this->fk_Etat;
    }
}
