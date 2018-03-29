<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modele
 *
 * @ORM\Table(name="modele")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\ModeleRepository")
 */
class Modele
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    public $nom;

    /**
     * @var int
     * @ORM\Column(name="Module", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Module", mappedBy="Modele")
     */
    private $fk_Module;

    /**
     * @var int
     * @ORM\Column(name="Devis", type="integer", nullable=true)
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Devis", mappedBy="Modele")
     */
    private $fk_Devis;




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
     * Set nom.
     *
     * @param string $nom
     *
     * @return Modele
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set fkModule.
     *
     * @param int $fkModule
     *
     * @return Modele
     */
    public function setFkModule($fkModule)
    {
        $this->fk_Module = $fkModule;

        return $this;
    }

    /**
     * Get fkModule.
     *
     * @return int
     */
    public function getFkModule()
    {
        return $this->fk_Module;
    }

    /**
     * Set fkDevis.
     *
     * @param int $fkDevis
     *
     * @return Modele
     */
    public function setFkDevis($fkDevis)
    {
        $this->fk_Devis = $fkDevis;

        return $this;
    }

    /**
     * Get fkDevis.
     *
     * @return int
     */
    public function getFkDevis()
    {
        return $this->fk_Devis;
    }

    /**
     * Set fkGamme.
     *
     * @param int $fkGamme
     *
     * @return Modele
     */
    public function setFkGamme($fkGamme)
    {
        $this->fk_Gamme = $fkGamme;

        return $this;
    }

    /**
     * Get fkGamme.
     *
     * @return int
     */
    public function getFkGamme()
    {
        return $this->fk_Gamme;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fk_Image = new \Doctrine\Common\Collections\ArrayCollection();
    }

    

    /**
     * Add fkGamme.
     *
     * @param \DevisBundle\Entity\Gamme $fkGamme
     *
     * @return Modele
     */
    public function addFkGamme(\DevisBundle\Entity\Gamme $fkGamme)
    {
        $this->fk_Gamme[] = $fkGamme;

        return $this;
    }

    /**
     * Remove fkGamme.
     *
     * @param \DevisBundle\Entity\Gamme $fkGamme
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFkGamme(\DevisBundle\Entity\Gamme $fkGamme)
    {
        return $this->fk_Gamme->removeElement($fkGamme);
    }
}
