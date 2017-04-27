<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Booking
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookingRepository")
 * @ORM\Table(name="booking")
 */
class Booking
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="bookings", cascade={"persist"})
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    protected $event;

    /**
     * @var TicketCategory
     *
     * @ORM\ManyToOne(targetEntity="TicketCategory", cascade={"persist"})
     * @ORM\JoinColumn(name="ticket_category_id", referencedColumnName="id")
     */
    protected $ticketCategory;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="main_user_id", referencedColumnName="id")
     */
    protected $mainUser;

    /**
     * @var User[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="User", cascade={"persist"})
     */
    protected $secondaryUsers;

    /**
     * @var Ticket[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="booking", cascade={"persist", "remove"})
     */
    protected $tickets;

    /**
     * Booking constructor.
     */
    public function __construct()
    {
        $this->secondaryUsers = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Event
     */
    public function getEvent():? Event
    {
        return $this->event;
    }

    /**
     * @param Event $event
     *
     * @return Booking
     */
    public function setEvent(Event $event): Booking
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return TicketCategory
     */
    public function getTicketCategory():? TicketCategory
    {
        return $this->ticketCategory;
    }

    /**
     * @param TicketCategory $ticketCategory
     *
     * @return Booking
     */
    public function setTicketCategory(TicketCategory $ticketCategory): Booking
    {
        $this->ticketCategory = $ticketCategory;

        return $this;
    }

    /**
     * @return User
     */
    public function getMainUser():? User
    {
        return $this->mainUser;
    }

    /**
     * @param mixed $mainUser
     *
     * @return Booking
     */
    public function setMainUser($mainUser)
    {
        $this->mainUser = $mainUser;

        return $this;
    }

    /**
     * @return User[]|ArrayCollection
     */
    public function getSecondaryUsers()
    {
        return $this->secondaryUsers;
    }

    /**
     * @param User[]|ArrayCollection $secondaryUsers
     *
     * @return Booking
     */
    public function setSecondaryUsers($secondaryUsers)
    {
        $this->secondaryUsers = $secondaryUsers;

        return $this;
    }

    /**
     * @param User $secondaryUser
     *
     * @return Booking
     */
    public function addSecondaryUser(User $secondaryUser)
    {
        if (!$this->secondaryUsers->contains($secondaryUser)) {
            $this->secondaryUsers->add($secondaryUser);
        }

        return $this;
    }

    /**
     * @param User $secondaryUser
     *
     * @return Booking
     */
    public function removeSecondaryUser(User $secondaryUser)
    {
        if ($this->secondaryUsers->contains($secondaryUser)) {
            $this->secondaryUsers->remove($secondaryUser);
        }

        return $this;
    }

    /**
     * @return Ticket[]|ArrayCollection
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * @param Ticket[]|ArrayCollection $tickets
     *
     * @return Booking
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;

        return $this;
    }

    public function getTicketCount()
    {
        return 1 + count($this->secondaryUsers);
    }
}
