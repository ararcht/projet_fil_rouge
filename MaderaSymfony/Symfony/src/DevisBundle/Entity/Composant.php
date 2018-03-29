<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composant
 *
 * @ORM\Table(name="composant")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\ComposantRepository")
 */
class Composant
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
     *
     * @ORM\Column(name="Longueur", type="integer")
     */
    private $longueur;

    /**
     * @var int
     *
     * @ORM\Column(name="Largeur", type="integer")
     */
    private $largeur;

    /**
     * @var int
     *
     * @ORM\Column(name="Taille", type="integer")
     */
    private $taille;

    /**
     * @var int
     *
     * @ORM\Column(name="Poids", type="integer")
     */
    private $poids;

    /**
     * @var int
     *
     * @ORM\Column(name="Stock", type="integer")
     */
    private $stock;

    /**
     * @var int
     *
     * @ORM\Column(name="Prix", type="integer")
     */
    private $prix;

    /**
     * @var int
     * @ORM\Column(name="Gamme", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Gamme", mappedBy="Composant")
     */
    private $fk_gamme;

    /**
     * @var int
     * @ORM\Column(name="Fournisseur", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Fournisseur", mappedBy="Composant")
     */
    private $fk_fournisseur;

    /**
     * @var int
     * @ORM\Column(name="Module", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Module", mappedBy="Composant")
     */
    private $fk_module;

    /**
     * @var int
     * @ORM\Column(name="Matiere", type="integer")
     * ORM\OneToOne(targetEntity="DevisBundle\Entity\Matiere", cascade={"persist"})
     */
    private $fk_matiere;

    /**
     * @var int
     * @ORM\Column(name="Teinte", type="integer")
     * ORM\OneToOne(targetEntity="DevisBundle\Entity\Teinte", cascade={"persist"})
     */
    private $fk_teinte;



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
     * @return Composant
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
     * Set longueur.
     *
     * @param int $longueur
     *
     * @return Composant
     */
    public function setLongueur($longueur)
    {
        $this->longueur = $longueur;

        return $this;
    }

    /**
     * Get longueur.
     *
     * @return int
     */
    public function getLongueur()
    {
        return $this->longueur;
    }

    /**
     * Set largeur.
     *
     * @param int $largeur
     *
     * @return Composant
     */
    public function setLargeur($largeur)
    {
        $this->largeur = $largeur;

        return $this;
    }

    /**
     * Get largeur.
     *
     * @return int
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * Set taille.
     *
     * @param int $taille
     *
     * @return Composant
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille.
     *
     * @return int
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set poids.
     *
     * @param int $poids
     *
     * @return Composant
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids.
     *
     * @return int
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set stock.
     *
     * @param int $stock
     *
     * @return Composant
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock.
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set prix.
     *
     * @param int $prix
     *
     * @return Composant
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
     * Set fkGamme.
     *
     * @param int $fkGamme
     *
     * @return Composant
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

    /**
     * Set fkFournisseur.
     *
     * @param int $fkFournisseur
     *
     * @return Composant
     */
    public function setFkFournisseur($fkFournisseur)
    {
        $this->fk_fournisseur = $fkFournisseur;

        return $this;
    }

    /**
     * Get fkFournisseur.
     *
     * @return int
     */
    public function getFkFournisseur()
    {
        return $this->fk_fournisseur;
    }

    /**
     * Set fkModule.
     *
     * @param int $fkModule
     *
     * @return Composant
     */
    public function setFkModule($fkModule)
    {
        $this->fk_module = $fkModule;

        return $this;
    }

    /**
     * Get fkModule.
     *
     * @return int
     */
    public function getFkModule()
    {
        return $this->fk_module;
    }

    /**
     * Set fkMatiere.
     *
     * @param int $fkMatiere
     *
     * @return Composant
     */
    public function setFkMatiere($fkMatiere)
    {
        $this->fk_matiere = $fkMatiere;

        return $this;
    }

    /**
     * Get fkMatiere.
     *
     * @return int
     */
    public function getFkMatiere()
    {
        return $this->fk_matiere;
    }

    /**
     * Set fkTeinte.
     *
     * @param int $fkTeinte
     *
     * @return Composant
     */
    public function setFkTeinte($fkTeinte)
    {
        $this->fk_teinte = $fkTeinte;

        return $this;
    }

    /**
     * Get fkTeinte.
     *
     * @return int
     */
    public function getFkTeinte()
    {
        return $this->fk_teinte;
    }
}
