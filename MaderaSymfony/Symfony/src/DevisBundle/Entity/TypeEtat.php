<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeEtat
 *
 * @ORM\Table(name="type_etat")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\TypeEtatRepository")
 */
class TypeEtat
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
     * @ORM\Column(name="Code", type="string", length=255)
     */
    private $code;

    /**
     * @var int
     * @ORM\Column(name="Etat", type="integer")
     * @ORM\OneToMany(targetEntity="DevisBundle\Entity\Etat", mappedBy="Etat")
     */
    private $fk_commande;


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
     * Set code.
     *
     * @param string $code
     *
     * @return TypeEtat
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}
