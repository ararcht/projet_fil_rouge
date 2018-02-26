<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devis
 *
 * @ORM\Table(name="devis")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\DevisRepository")
 */
class Devis
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
     * @var string
     *
     * @ORM\Column(name="Numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Devis", type="datetime")
     */
    private $dateDevis;


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
     * Set numero.
     *
     * @param string $numero
     *
     * @return Devis
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero.
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set dateDevis.
     *
     * @param \DateTime $dateDevis
     *
     * @return Devis
     */
    public function setDateDevis($dateDevis)
    {
        $this->dateDevis = $dateDevis;

        return $this;
    }

    /**
     * Get dateDevis.
     *
     * @return \DateTime
     */
    public function getDateDevis()
    {
        return $this->dateDevis;
    }
}
