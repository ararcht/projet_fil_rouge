<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Module
 *
 * @ORM\Table(name="module")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\ModuleRepository")
 */
class Module
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
    public $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="Prix", type="integer")
     */
    public $prix;


    /**
     * @var int
     * @ORM\Column(name="Composant", type="integer")
     * @ORM\ManyToMany(targetEntity="DevisBundle\Entity\Composant", cascade={"persist"})
     */
    private $fk_composant;

    /**
     * @var int
     * @ORM\Column(name="Type_Module", type="integer")
     * ORM\OneToOne(targetEntity="DevisBundle\Entity\TypeModule", cascade={"persist"})
     */
    private $fk_typeModule;

    /**
     * @var int
     * @ORM\Column(name="Devis", type="integer", nullable=true)
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Devis", mappedBy="Module")
     */
    private $fk_devis;

    /**
     * @var int
     * @ORM\Column(name="Gamme", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Gamme", mappedBy="Module")
     */
    private $fk_gamme;


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
     * @return Module
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
     * Set prix.
     *
     * @param int $prix
     *
     * @return Module
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

    /**
     * Set fkComposant.
     *
     * @param int $fkComposant
     *
     * @return Module
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
     * Set fkTypeModule.
     *
     * @param int $fkTypeModule
     *
     * @return Module
     */
    public function setFkTypeModule($fkTypeModule)
    {
        $this->fk_typeModule = $fkTypeModule;

        return $this;
    }

    /**
     * Get fkTypeModule.
     *
     * @return int
     */
    public function getFkTypeModule()
    {
        return $this->fk_typeModule;
    }

    /**
     * Set fkDevis.
     *
     * @param int $fkDevis
     *
     * @return Module
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
     * Set fkGamme.
     *
     * @param int $fkGamme
     *
     * @return Module
     */
    public function setFkGamme($fkGamme)
    {
        $this->fk_gamme = $fkGamme;

        return $this;
    }

    /**
     * Get fkGamme.
     *
     * @return int
     */
    public function getFkGamme()
    {
        return $this->fk_gamme;
    }
}
