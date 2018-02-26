<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gamme
 *
 * @ORM\Table(name="gamme")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\GammeRepository")
 */
class Gamme
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
     * @ORM\Column(name="Modele", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Modele", mappedBy="Modele")
     */
    private $fk_modele;

    /**
     * @var int
     * @ORM\Column(name="Composant", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Composant", mappedBy="Composant")
     */
    private $fk_composant;


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
     * @return Gamme
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
}
