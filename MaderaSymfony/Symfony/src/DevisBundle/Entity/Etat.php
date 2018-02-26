<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table(name="etat")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\EtatRepository")
 */
class Etat
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
     * @ORM\Column(name="Commande", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Commande", mappedBy="Commande")
     */
    private $fk_commande;

    /**
     * @var int
     * @ORM\Column(name="Paiement", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Paiement", mappedBy="Paiement")
     */
    private $fk_paiement;

    /**
     * @var int
     * @ORM\Column(name="Devis", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Devis", mappedBy="Devis")
     */
    private $fk_devis;

    /**
     * @var int
     * @ORM\Column(name="Type", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\TypeEtat", mappedBy="Type")
     */
    private $fk_type;

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
     * @return Etat
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
