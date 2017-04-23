<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class User
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    const USER_ROLE_SUPER_ADMIN = "ROLE_SUPER_ADMIN";
    const USER_ROLE_OBSERVATORY = "ROLE_OBSERVATORY";
    const USER_ROLE_AGENT       = "ROLE_AGENT";
    const USER_ROLE_BENEFICIARY = "ROLE_BENEFICIARY";

    const USER_CIVILITY_MAN   = "man";
    const USER_CIVILITY_WOMAN = "woman";

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $civility;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
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
     * @ORM\Column(type="string", nullable=true)
     */
    protected $address;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $zipCode;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $city;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $phone;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
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
        $this->birthdayDate = null;
        $this->roles        = [self::USER_ROLE_BENEFICIARY];
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCivility(): ?string
    {
        return $this->civility;
    }

    /**
     * @param string $civility
     *
     * @return $this
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdayDate(): ?\DateTime
    {
        return $this->birthdayDate;
    }

    /**
     * @param \DateTime $birthdayDate
     *
     * @return $this
     */
    public function setBirthdayDate($birthdayDate)
    {
        $this->birthdayDate = $birthdayDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
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
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     *
     * @return $this
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdNumber(): ?string
    {
        return $this->idNumber;
    }

    /**
     * @param string $idNumber
     *
     * @return $this
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        parent::setUsername($email);

        return $this;
    }

    /**
     * @return bool
     */
    public function isLower()
    {
        $todayDate = new \DateTime();
        if ($this->birthdayDate > $todayDate) {

            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public static function getAvailableCivilities()
    {
        return [
            'app.civility.man'   => self::USER_CIVILITY_MAN,
            'app.civility.woman' => self::USER_CIVILITY_WOMAN,
        ];
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
