<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teinte
 *
 * @ORM\Table(name="teinte")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\TeinteRepository")
 */
class Teinte
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
     * @ORM\Column(name="Code_Teinte", type="string", length=255)
     */
    private $codeTeinte;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;


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
     * Set codeTeinte.
     *
     * @param string $codeTeinte
     *
     * @return Teinte
     */
    public function setCodeTeinte($codeTeinte)
    {
        $this->codeTeinte = $codeTeinte;

        return $this;
    }

    /**
     * Get codeTeinte.
     *
     * @return string
     */
    public function getCodeTeinte()
    {
        return $this->codeTeinte;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Teinte
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
