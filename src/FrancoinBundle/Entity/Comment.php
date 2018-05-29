<?php

namespace FrancoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="FrancoinBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\Advert", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
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
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;


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
     * Set content
     *
     * @param string $content
     *
     * @return Comment
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
     * Set advert
     *
     * @param \FrancoinBundle\Entity\Advert $advert
     *
     * @return Comment
     */
    public function setAdvert(\FrancoinBundle\Entity\Advert $advert)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \FrancoinBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }
}
