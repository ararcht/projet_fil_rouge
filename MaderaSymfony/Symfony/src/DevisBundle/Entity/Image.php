<?php

namespace DevisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="DevisBundle\Repository\ImageRepository")
 */
class Image
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
   * @ORM\ManyToMany(targetEntity="DevisBundle\Entity\Modele", cascade={"persist"})
   */
    private $fk_Modele;


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
     * Set url.
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Image
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fk_Modele = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fkModele.
     *
     * @param \DevisBundle\Entity\Modele $fkModele
     *
     * @return Image
     */
    public function addFkModele(\DevisBundle\Entity\Modele $fkModele)
    {
        $this->fk_Modele[] = $fkModele;

        return $this;
    }

    /**
     * Remove fkModele.
     *
     * @param \DevisBundle\Entity\Modele $fkModele
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFkModele(\DevisBundle\Entity\Modele $fkModele)
    {
        return $this->fk_Modele->removeElement($fkModele);
    }

    /**
     * Get fkModele.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFkModele()
    {
        return $this->fk_Modele;
    }
}
