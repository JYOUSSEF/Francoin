<?php

namespace FrancoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="Post_Category", columns={"Category_id"}), @ORM\Index(name="Post_City", columns={"City_id"}), @ORM\Index(name="Post_Region", columns={"Region_id"}), @ORM\Index(name="Post_User", columns={"User_id"})})
 * @ORM\Entity
 */
class Post
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=false)
     */
    private $content;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="date", nullable=false)
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_date", type="date", nullable=false)
     */
    private $publishedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_date", type="date", nullable=false)
     */
    private $updatedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration_date", type="date", nullable=false)
     */
    private $expirationDate;

    /**
     * @var \FrancoinBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \FrancoinBundle\Entity\City
     *
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="City_id", referencedColumnName="id")
     * })
     */
    private $city;

    /**
     * @var \FrancoinBundle\Entity\Region
     *
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\Region")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Region_id", referencedColumnName="id")
     * })
     */
    private $region;

    /**
     * @var \FrancoinBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set type
     *
     * @param string $type
     *
     * @return Post
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Post
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Post
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set publishedDate
     *
     * @param \DateTime $publishedDate
     *
     * @return Post
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = $publishedDate;

        return $this;
    }

    /**
     * Get publishedDate
     *
     * @return \DateTime
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     *
     * @return Post
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Set expirationDate
     *
     * @param \DateTime $expirationDate
     *
     * @return Post
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get expirationDate
     *
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set category
     *
     * @param \FrancoinBundle\Entity\Category $category
     *
     * @return Post
     */
    public function setCategory(\FrancoinBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \FrancoinBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set city
     *
     * @param \FrancoinBundle\Entity\City $city
     *
     * @return Post
     */
    public function setCity(\FrancoinBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \FrancoinBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set region
     *
     * @param \FrancoinBundle\Entity\Region $region
     *
     * @return Post
     */
    public function setRegion(\FrancoinBundle\Entity\Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \FrancoinBundle\Entity\Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set user
     *
     * @param \FrancoinBundle\Entity\User $user
     *
     * @return Post
     */
    public function setUser(\FrancoinBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \FrancoinBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
