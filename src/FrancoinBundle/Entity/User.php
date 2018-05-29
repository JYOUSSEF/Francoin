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
}