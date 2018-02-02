<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsrType
 *
 * @ORM\Table(name="usr_type")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\UsrTypeRepository")
 */
class UsrType
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
     * @ORM\Column(name="Type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Droits", type="string", length=255)
     */
    private $droits;


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
     * Set type.
     *
     * @param string $type
     *
     * @return UsrType
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set droits.
     *
     * @param string $droits
     *
     * @return UsrType
     */
    public function setDroits($droits)
    {
        $this->droits = $droits;

        return $this;
    }

    /**
     * Get droits.
     *
     * @return string
     */
    public function getDroits()
    {
        return $this->droits;
    }
}
