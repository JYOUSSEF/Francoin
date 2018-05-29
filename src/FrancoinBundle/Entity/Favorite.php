<?php

namespace FrancoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favorite
 *
 * @ORM\Table(name="favorite")
 * @ORM\Entity(repositoryClass="FrancoinBundle\Repository\FavoriteRepository")
 */
class Favorite
{

    /**
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\Advert",inversedBy="favorites")
     * @ORM\JoinColumn(nullable=false)
     */

    private $advert;

    /**
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\UserFran", inversedBy="favorites")
     * @ORM\JoinColumn(nullable=false)
     */

    private $userfran;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



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
     * Set advert
     *
     * @param \FrancoinBundle\Entity\Advert $advert
     *
     * @return Favorite
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

    /**
     * Set userfran
     *
     * @param \FrancoinBundle\Entity\UserFran $userfran
     *
     * @return Favorite
     */
    public function setUserfran(\FrancoinBundle\Entity\UserFran $userfran)
    {
        $this->userfran = $userfran;

        return $this;
    }

    /**
     * Get userfran
     *
     * @return \FrancoinBundle\Entity\UserFran
     */
    public function getUserfran()
    {
        return $this->userfran;
    }
}
