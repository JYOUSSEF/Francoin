<?php

namespace FrancoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category", indexes={@ORM\Index(name="Category_Category", columns={"parent_id"})})
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=35, nullable=false)
     */
    private $name;

    /**
     * @var \FrancoinBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="FrancoinBundle\Entity\Attribute", inversedBy="category")
     * @ORM\JoinTable(name="categoryattribute",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Category_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Attribute_id", referencedColumnName="id")
     *   }
     * )
     */
    private $attribute;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attribute = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
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
     * @param \FrancoinBundle\Entity\Category $parent
     *
     * @return Category
     */
    public function setParent(\FrancoinBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \FrancoinBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
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
        $this->attribute[] = $attribute;

        return $this;
    }

    /**
     * Remove attribute
     *
     * @param \FrancoinBundle\Entity\Attribute $attribute
     */
    public function removeAttribute(\FrancoinBundle\Entity\Attribute $attribute)
    {
        $this->attribute->removeElement($attribute);
    }

    /**
     * Get attribute
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttribute()
    {
        return $this->attribute;
    }
}
