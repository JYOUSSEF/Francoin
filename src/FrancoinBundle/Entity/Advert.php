<?php

namespace FrancoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="FrancoinBundle\Repository\AdvertRepository")
 */
class Advert
{

    /**
     * @ORM\OneToMany(targetEntity="FrancoinBundle\Entity\Favorite", mappedBy="advert")
     */

    private $favorites;

    /**
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\UserFran", inversedBy="advert")
     */

    private $annonceurs;

    /**
     * @ORM\OneToMany(targetEntity="FrancoinBundle\Entity\Picture", mappedBy="advert")
     */

    private $pictures;

    /**
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\Category", inversedBy="advert")
     * @ORM\JoinColumn(nullable=false)
     */

    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="FrancoinBundle\Entity\Comment", mappedBy="advert")
     */
    private $comments;
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->favorites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Advert
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
     * @return Advert
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Advert
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Advert
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Advert
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Add favorite
     *
     * @param \FrancoinBundle\Entity\Favorite $favorite
     *
     * @return Advert
     */
    public function addFavorite(\FrancoinBundle\Entity\Favorite $favorite)
    {
        $this->favorites[] = $favorite;

        return $this;
    }

    /**
     * Remove favorite
     *
     * @param \FrancoinBundle\Entity\Favorite $favorite
     */
    public function removeFavorite(\FrancoinBundle\Entity\Favorite $favorite)
    {
        $this->favorites->removeElement($favorite);
    }

    /**
     * Get favorites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavorites()
    {
        return $this->favorites;
    }

    /**
     * Set annonceurs
     *
     * @param \FrancoinBundle\Entity\UserFran $annonceurs
     *
     * @return Advert
     */
    public function setAnnonceurs(\FrancoinBundle\Entity\UserFran $annonceurs = null)
    {
        $this->annonceurs = $annonceurs;

        return $this;
    }

    /**
     * Get annonceurs
     *
     * @return \FrancoinBundle\Entity\UserFran
     */
    public function getAnnonceurs()
    {
        return $this->annonceurs;
    }

    /**
     * Add picture
     *
     * @param \FrancoinBundle\Entity\Picture $picture
     *
     * @return Advert
     */
    public function addPicture(\FrancoinBundle\Entity\Picture $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \FrancoinBundle\Entity\Picture $picture
     */
    public function removePicture(\FrancoinBundle\Entity\Picture $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Set categories
     *
     * @param \FrancoinBundle\Entity\Category $categories
     *
     * @return Advert
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

    /**
     * Add comment
     *
     * @param \FrancoinBundle\Entity\Comment $comment
     *
     * @return Advert
     */
    public function addComment(\FrancoinBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \FrancoinBundle\Entity\Comment $comment
     */
    public function removeComment(\FrancoinBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
