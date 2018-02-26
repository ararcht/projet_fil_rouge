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
     * @var int
     * @ORM\Column(name="Commande", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Commande", mappedBy="Devis")
     */
    private $fk_commande;

    /**
     * @var int
     * @ORM\Column(name="Utilisateur", type="integer")
     * ORM\OneToOne(targetEntity="DevisBundle\Entity\Utilisateur", cascade={"persist"})
     */
    private $fk_utilisateur;

    /**
     * @var int
     * @ORM\Column(name="Etat", type="integer")
     * ORM\OneToOne(targetEntity="DevisBundle\Entity\Etat", cascade={"persist"})
     */
    private $fk_etat;

    /**
     * @var int
     * @ORM\Column(name="Modele", type="integer")
     * ORM\OneToOne(targetEntity="DevisBundle\Entity\Modele", cascade={"persist"})
     */
    private $fk_modele;

    /**
     * @var int
     * @ORM\Column(name="Module", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Module", mappedBy="Devis")
     */
    private $fk_Module;

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

    /**
     * Get id fk Commande.
     *
     * @return int
     */
    public function getFkCommande()
    {
        return $this->fk_commande;
    }

    /**
     * Set id fk commande.
     *
     * @param int $id
     *
     * @return Commande
     */
    public function setFkCommande($id)
    {
        $this->fk_commande = $id;
        return $this;
    }

     /**
     * Get id fk Module.
     *
     * @return int
     */
    public function getFkModule()
    {
        return $this->fk_Module;
    }

    /**
     * Set id fk Module.
     *
     * @param int $id
     *
     * @return Module
     */
    public function setFkModule($id)
    {
        $this->fk_Module = $id;
        return $this;
    }

    /**
     * Get id fk Modele.
     *
     * @return int
     */
    public function getFkModel()
    {
        return $this->fk_modele;
    }

    /**
     * Set id fk Modele.
     *
     * @param int $id
     *
     * @return Modele
     */
    public function setFkModele($id)
    {
        $this->fk_modele = $id;
        return $this;
    }
    
    /**
     * Get id fk Etat.
     *
     * @return int
     */
    public function getFkEtat()
    {
        return $this->fk_etat;
    }

    /**
     * Set id fk Etat.
     *
     * @param int $id
     *
     * @return Etat
     */
    public function setFkEtat($id)
    {
        $this->fk_etat = $id;
        return $this;
    }

    /**
     * Get id fk Utilisateur.
     *
     * @return int
     */
    public function getFkUtilisateur()
    {
        return $this->fk_utilisateur;
    }

    /**
     * Set id fk Utilisateur.
     *
     * @param int $id
     *
     * @return Etat
     */
    public function setFkUtilisateur($id)
    {
        $this->fk_utilisateur = $id;
        return $this;
    }
}
