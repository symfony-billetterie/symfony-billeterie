<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $civility;

    /**
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    protected $birthdayDate;

    /**
     * @var
     * @ORM\Column(type="string")
     */
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $address;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $zipCode;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $phone;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $idCard;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $idNumber;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->birthdayDate = new \DateTime();
    }
}
