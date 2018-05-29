<?php

namespace FrancoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attribute
 *
 * @ORM\Table(name="attribute")
 * @ORM\Entity(repositoryClass="FrancoinBundle\Repository\AttributeRepository")
 */
class Attribute
{
    /**
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\Category", inversedBy="attributes")
     * @ORM\JoinColumn(nullable=false)
     */
private $categories;

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set categories
     *
     * @param \FrancoinBundle\Entity\Category $categories
     *
     * @return Attribute
     */
    public function setCategories(\FrancoinBundle\Entity\Category $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return \FrancoinBundle\Entity\Category
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
