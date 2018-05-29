<?php

namespace FrancoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="FrancoinBundle\Repository\CategoryRepository")
 */
class Category
{

    /**
     * @ORM\OneToMany(targetEntity="FrancoinBundle\Entity\Attribute", mappedBy="categories")
     */
    private $attributes;
    /**
     * @ORM\OneToMany(targetEntity="FrancoinBundle\Entity\Advert", mappedBy="categories")
     */
    private $advert;

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
     * @var string
     *
     * @ORM\Column(name="parent", type="string", length=255)
     */
    private $parent;


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
     * @return Category
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
     * Set parent
     *
     * @param string $parent
     *
     * @return Category
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attributes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->advert = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add attribute
     *
     * @param \FrancoinBundle\Entity\Attribute $attribute
     *
     * @return Category
     */
    public function addAttribute(\FrancoinBundle\Entity\Attribute $attribute)
    {
        $this->attributes[] = $attribute;

        return $this;
    }

    /**
     * Remove attribute
     *
     * @param \FrancoinBundle\Entity\Attribute $attribute
     */
    public function removeAttribute(\FrancoinBundle\Entity\Attribute $attribute)
    {
        $this->attributes->removeElement($attribute);
    }

    /**
     * Get attributes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Add advert
     *
     * @param \FrancoinBundle\Entity\Advert $advert
     *
     * @return Category
     */
    public function addAdvert(\FrancoinBundle\Entity\Advert $advert)
    {
        $this->advert[] = $advert;

        return $this;
    }

    /**
     * Remove advert
     *
     * @param \FrancoinBundle\Entity\Advert $advert
     */
    public function removeAdvert(\FrancoinBundle\Entity\Advert $advert)
    {
        $this->advert->removeElement($advert);
    }

    /**
     * Get advert
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvert()
    {
        return $this->advert;
    }
}
