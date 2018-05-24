<?php

namespace FOS\UserBundle\Model;


/**
 * Group
 */
class Group
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=180, unique=true)
     */
    protected $name;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    protected $roles;


}

