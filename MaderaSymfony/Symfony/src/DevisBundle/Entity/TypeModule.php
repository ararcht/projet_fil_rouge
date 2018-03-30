<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeModule
 *
 * @ORM\Table(name="type_module")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\TypeModuleRepository")
 */
class TypeModule
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
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Module", mappedBy="TypeModule")
     */
    private $fk_module;

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
     * @return TypeModule
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
     * @return TypeModule
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
}
