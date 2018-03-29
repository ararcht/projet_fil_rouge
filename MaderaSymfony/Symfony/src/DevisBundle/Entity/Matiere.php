<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\MatiereRepository")
 */
class Matiere
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
     * @ORM\Column(name="Matiere", type="string", length=255)
     */
    public $matiere;

    /**
     * @var int
     * @ORM\Column(name="Composant", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Composant", mappedBy="Matiere")
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
     * Set matiere.
     *
     * @param string $matiere
     *
     * @return Matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere.
     *
     * @return string
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * Set fkComposant.
     *
     * @param int $fkComposant
     *
     * @return Matiere
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
}
