<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\UtilisateurRepository")
 */
class Utilisateur
{

    /**
     * @ORM\Column(name="UsrType",type="integer")
     * @ORM\ManyToOne(targetEntity="DevisBundle\Entity\UsrType")
     */
     private $fk_usrType;

     public function setUserType(UserType $fk_usrType)
     {
       $this->fk_usrType = $fk_usrType;
       return $this;
     }

     public function getUserType()
     {
       return $this->fk_usrType;
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
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="Num_Portable", type="string", length=255)
     */
    private $numPortable;

    /**
     * @var string
     *
     * @ORM\Column(name="Num_Fixe", type="string", length=255)
     */
    private $numFixe;

    /**
     * @var string
     *
     * @ORM\Column(name="Login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="Mdp", type="string", length=255)
     */
    private $mdp;

    /**
     * @var bool
     *
     * @ORM\Column(name="Actif", type="boolean")
     */
    private $actif;


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
     * @return Utilisateur
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
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail.
     *
     * @param string $mail
     *
     * @return Utilisateur
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set numPortable.
     *
     * @param string $numPortable
     *
     * @return Utilisateur
     */
    public function setNumPortable($numPortable)
    {
        $this->numPortable = $numPortable;

        return $this;
    }

    /**
     * Get numPortable.
     *
     * @return string
     */
    public function getNumPortable()
    {
        return $this->numPortable;
    }

    /**
     * Set numFixe.
     *
     * @param string $numFixe
     *
     * @return Utilisateur
     */
    public function setNumFixe($numFixe)
    {
        $this->numFixe = $numFixe;

        return $this;
    }

    /**
     * Get numFixe.
     *
     * @return string
     */
    public function getNumFixe()
    {
        return $this->numFixe;
    }

    /**
     * Set login.
     *
     * @param string $login
     *
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set mdp.
     *
     * @param string $mdp
     *
     * @return Utilisateur
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp.
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set actif.
     *
     * @param bool $actif
     *
     * @return Utilisateur
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif.
     *
     * @return bool
     */
    public function getActif()
    {
        return $this->actif;
    }
}
