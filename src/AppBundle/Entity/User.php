<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class User
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    const USER_ROLE_SUPER_ADMIN = "ROLE_SUPER_ADMIN";
    const USER_ROLE_OBSERVATORY = "ROLE_OBSERVATORY";
    const USER_ROLE_AGENT       = "ROLE_AGENT";
    const USER_ROLE_BENEFICIARY = "ROLE_BENEFICIARY";

    /**
     * @var int
     *
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
    protected $lastName;

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
     * @Gedmo\Slug(fields={"firstName","lastName"}, separator="-", updatable=true, unique=true)
     * @ORM\Column(length=255, unique=true)
     */
    protected $slug;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->birthdayDate = new \DateTime();
    }

    /**
     * @return string
     */
    public function getCivility(): string
    {
        return $this->civility;
    }

    /**
     * @param string $civility
     *
     * @return User
     */
    public function setCivility(string $civility): User
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdayDate(): \DateTime
    {
        return $this->birthdayDate;
    }

    /**
     * @param \DateTime $birthdayDate
     *
     * @return User
     */
    public function setBirthdayDate(\DateTime $birthdayDate): User
    {
        $this->birthdayDate = $birthdayDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return User
     */
    public function setAddress(string $address): User
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return User
     */
    public function setCity(string $city): User
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     *
     * @return User
     */
    public function setZipCode(string $zipCode): User
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return User
     */
    public function setPhone(string $phone): User
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdCard(): string
    {
        return $this->idCard;
    }

    /**
     * @param string $idCard
     *
     * @return User
     */
    public function setIdCard(string $idCard): User
    {
        $this->idCard = $idCard;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdNumber(): string
    {
        return $this->idNumber;
    }

    /**
     * @param string $idNumber
     *
     * @return User
     */
    public function setIdNumber(string $idNumber): User
    {
        $this->idNumber = $idNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
