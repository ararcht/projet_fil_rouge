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
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     * @ORM\Column(name="Module", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Module", mappedBy="Modele")
     */
    private $fk_Module;

    /**
     * @var int
     * @ORM\Column(name="Devis", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Devis", mappedBy="Modele")
     */
    private $fk_Devis;

    /**
     * @var int
     * @ORM\Column(name="Gamme", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Gamme", mappedBy="Modele")
     */
    private $fk_Gamme;


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
}
