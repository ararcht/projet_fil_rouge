<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BonCommande
 *
 * @ORM\Table(name="bon_commande")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\BonCommandeRepository")
 */
class BonCommande
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
     * @ORM\Column(name="prix", type="decimal", precision=10, scale=0)
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(name="Date", type="integer")
     * @ORM\OneToOne(targetEntity="DevisBundle\Entity\Date", cascade={"persist"})
     */
    private $fk_date;

    /**
     * @ORM\Column(name="Fournisseur", type="integer")
     * @ORM\OneToOne(targetEntity="DevisBundle\Entity\Fournisseur", cascade={"persist"})
     */
    private $fk_fournisseur;


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
     * Set prix.
     *
     * @param string $prix
     *
     * @return BonCommande
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix.
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set quantite.
     *
     * @param int $quantite
     *
     * @return BonCommande
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite.
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set fkDate.
     *
     * @param int $fkDate
     *
     * @return BonCommande
     */
    public function setFkDate($fkDate)
    {
        $this->fk_date = $fkDate;

        return $this;
    }

    /**
     * Get fkDate.
     *
     * @return int
     */
    public function getFkDate()
    {
        return $this->fk_date;
    }

    /**
     * Set fkFournisseur.
     *
     * @param int $fkFournisseur
     *
     * @return BonCommande
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
}
