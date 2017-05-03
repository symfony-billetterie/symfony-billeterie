<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity()
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="distributed", type="boolean")
     */
    private $distributed= false;

    /**
     * @var string
     *
     * @ORM\Column(name="door", type="string", nullable=true)
     */
    private $door;

    /**
     * @var string
     *
     * @ORM\Column(name="floor", type="string", nullable=true)
     */
    private $floor;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", nullable=true)
     */
    private $number;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var Booking
     *
     * @ORM\ManyToOne(targetEntity="Booking", inversedBy="tickets")
     * @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     */
    protected $booking;

    public function __construct()
    {
        $this->distributed = false;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function isDistributed()
    {
        return $this->distributed;
    }

    /**
     * @param boolean $distributed
     *
     * @return Ticket
     */
    public function setDistributed($distributed)
    {
        $this->distributed = $distributed;

        return $this;
    }

    /**
     * @return string
     */
    public function getDoor()
    {
        return $this->door;
    }

    /**
     * @param string $door
     *
     * @return Ticket
     */
    public function setDoor($door)
    {
        $this->door = $door;

        return $this;
    }

    /**
     * @return string
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param string $floor
     *
     * @return Ticket
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return Ticket
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Booking
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * @param Booking $booking
     */
    public function setBooking($booking)
    {
        $this->booking = $booking;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Ticket
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
