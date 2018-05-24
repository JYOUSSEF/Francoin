<?php

namespace FrancoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\AttributeOverride;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="User_City", columns={"City_id"}), @ORM\Index(name="User_Region", columns={"Region_id"})})
 * @ORM\Entity
 * @AttributeOverrides({
 *      @AttributeOverride(name="username",
 *          column=@Column(name="username", type="string", unique=true, length=25, nullable=false)
 *      ),
 *      @AttributeOverride(name="email",
 *          column=@Column(name="email", type="string", unique=true, length=60, nullable=false)
 *      ),
 *      @AttributeOverride(name="password",
 *          column=@Column(name="password", type="string", length=25, nullable=false)
 *      )
 * })
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=35, nullable=false)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=35, nullable=false)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    protected $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=10, nullable=false)
     */
    protected $phone;

    /* *
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=60, nullable=false)
     * /
    protected $email;

    /* *
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=25, nullable=false)
     * /
    protected $username;

    /* *
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=25, nullable=false)
     * /
    protected $password;
    */

    /**
     * @var \FrancoinBundle\Entity\City
     *
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="City_id", referencedColumnName="id")
     * })
     */
    protected $city;

    /**
     * @var \FrancoinBundle\Entity\Region
     *
     * @ORM\ManyToOne(targetEntity="FrancoinBundle\Entity\Region")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Region_id", referencedColumnName="id")
     * })
     */
    protected $region;



    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set city
     *
     * @param \FrancoinBundle\Entity\City $city
     *
     * @return User
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
     * @return User
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
}
