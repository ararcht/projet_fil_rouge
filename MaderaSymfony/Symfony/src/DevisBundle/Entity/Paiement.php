<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\PaiementRepository")
 */
class Paiement
{
    /**
     * @ORM\Column(name="MoyenPaiement",type="integer")
     * @ORM\ManyToOne(targetEntity="DevisBundle\Entity\MoyenPaiement")
     */
     private $fk_moyenPaiement;

     public function setmoyenPaiement(UserType $fk_moyenPaiement)
     {
       $this->fk_moyenPaiement = $fk_moyenPaiement;
       return $this;
     }

     public function getmoyenPaiement()
     {
       return $this->fk_moyenPaiement;
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
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Echeance", type="datetime")
     */
    private $dateEcheance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Paiement", type="datetime")
     */
    private $datePaiement;

    /**
     * @var int
     *
     * @ORM\Column(name="Montant", type="integer")
     */
    private $montant;


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
     * Set dateEcheance.
     *
     * @param \DateTime $dateEcheance
     *
     * @return Paiement
     */
    public function setDateEcheance($dateEcheance)
    {
        $this->dateEcheance = $dateEcheance;

        return $this;
    }

    /**
     * Get dateEcheance.
     *
     * @return \DateTime
     */
    public function getDateEcheance()
    {
        return $this->dateEcheance;
    }

    /**
     * Set datePaiement.
     *
     * @param \DateTime $datePaiement
     *
     * @return Paiement
     */
    public function setDatePaiement($datePaiement)
    {
        $this->datePaiement = $datePaiement;

        return $this;
    }

    /**
     * Get datePaiement.
     *
     * @return \DateTime
     */
    public function getDatePaiement()
    {
        return $this->datePaiement;
    }

    /**
     * Set montant.
     *
     * @param int $montant
     *
     * @return Paiement
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant.
     *
     * @return int
     */
    public function getMontant()
    {
        return $this->montant;
    }
}
