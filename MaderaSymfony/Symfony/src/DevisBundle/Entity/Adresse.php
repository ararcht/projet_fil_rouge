<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\AdresseRepository")
 */
class Adresse
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
     * @ORM\Column(name="Numero_Voie", type="string", length=255)
     */
    private $numeroVoie;

    /**
     * @var string
     *
     * @ORM\Column(name="Voie", type="string", length=255)
     */
    private $voie;

    /**
     * @var string
     *
     * @ORM\Column(name="Complement_Adr", type="string", length=255)
     */
    private $complementAdr;

    /**
     * @var string
     *
     * @ORM\Column(name="Cp", type="string", length=255)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Adresse", type="string", length=255)
     */
    private $nomAdresse;


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
     * Set numeroVoie.
     *
     * @param string $numeroVoie
     *
     * @return Adresse
     */
    public function setNumeroVoie($numeroVoie)
    {
        $this->numeroVoie = $numeroVoie;

        return $this;
    }

    /**
     * Get numeroVoie.
     *
     * @return string
     */
    public function getNumeroVoie()
    {
        return $this->numeroVoie;
    }

    /**
     * Set voie.
     *
     * @param string $voie
     *
     * @return Adresse
     */
    public function setVoie($voie)
    {
        $this->voie = $voie;

        return $this;
    }

    /**
     * Get voie.
     *
     * @return string
     */
    public function getVoie()
    {
        return $this->voie;
    }

    /**
     * Set complementAdr.
     *
     * @param string $complementAdr
     *
     * @return Adresse
     */
    public function setComplementAdr($complementAdr)
    {
        $this->complementAdr = $complementAdr;

        return $this;
    }

    /**
     * Get complementAdr.
     *
     * @return string
     */
    public function getComplementAdr()
    {
        return $this->complementAdr;
    }

    /**
     * Set cp.
     *
     * @param string $cp
     *
     * @return Adresse
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp.
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville.
     *
     * @param string $ville
     *
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set nomAdresse.
     *
     * @param string $nomAdresse
     *
     * @return Adresse
     */
    public function setNomAdresse($nomAdresse)
    {
        $this->nomAdresse = $nomAdresse;

        return $this;
    }

    /**
     * Get nomAdresse.
     *
     * @return string
     */
    public function getNomAdresse()
    {
        return $this->nomAdresse;
    }
}
