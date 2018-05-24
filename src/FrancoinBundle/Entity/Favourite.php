<?php

namespace FrancoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favourite
 *
 * @ORM\Table(name="favourite", indexes={@ORM\Index(name="Favourite_Post", columns={"Post_id"}), @ORM\Index(name="Favourite_User", columns={"User_id"})})
 * @ORM\Entity
 */
class Favourite
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
     * @var \FrancoinBundle\Entity\Post
     *
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Post_id", referencedColumnName="id")
     * })
     */
    private $post;

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
     * Set post
     *
     * @param \FrancoinBundle\Entity\Post $post
     *
     * @return Favourite
     */
    public function setPost(\FrancoinBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \FrancoinBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set user
     *
     * @param \FrancoinBundle\Entity\User $user
     *
     * @return Favourite
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
