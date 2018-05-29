<?php
/**
 * Created by PhpStorm.
 * User: Anas
 * Date: 29/05/2018
 * Time: 00:03
 */

namespace FrancoinBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package FrancoinBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="user_fran")
 */
class UserFran extends BaseUser
{
    /**
     * @ORM\OneToMany(targetEntity="FrancoinBundle\Entity\Advert", mappedBy="annonceurs")
     */
    private $advert;

    /**
     * @ORM\OneToMany(targetEntity="FrancoinBundle\Entity\Favorite", mappedBy="userfran")
     */

    private $favorites;

    /**
     * @var integer
     *
     * @ORM\Id
     *
     * @ORM\Column(type="integer")
     *
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }



    /**
     * Add advert
     *
     * @param \FrancoinBundle\Entity\Advert $advert
     *
     * @return UserFran
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

    /**
     * Add favorite
     *
     * @param \FrancoinBundle\Entity\Favorite $favorite
     *
     * @return UserFran
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
}
