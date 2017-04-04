<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Booking
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    protected $event;

    /**
     * @var TicketCategory
     *
     * @ORM\ManyToOne(targetEntity="TicketCategory")
     * @ORM\JoinColumn(name="ticket_category_id", referencedColumnName="id")
     */
    protected $ticketCategory;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="main_user_id", referencedColumnName="id")
     */
    protected $mainUser;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="secondary_user_id", referencedColumnName="id")
     */
    protected $secondaryUser;

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
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @param Event $event
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
    public function getTicketCategory(): TicketCategory
    {
        return $this->ticketCategory;
    }

    /**
     * @param TicketCategory $ticketCategory
     * @return Booking
     */
    public function setTicketCategory(TicketCategory $ticketCategory): Booking
    {
        $this->ticketCategory = $ticketCategory;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMainUser(): User
    {
        return $this->mainUser;
    }

    /**
     * @param mixed $mainUser
     * @return Booking
     */
    public function setMainUser($mainUser)
    {
        $this->mainUser = $mainUser;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecondaryUser():? User
    {
        return $this->secondaryUser;
    }

    /**
     * @param mixed $secondaryUser
     * @return Booking
     */
    public function setSecondaryUser($secondaryUser)
    {
        $this->secondaryUser = $secondaryUser;
        return $this;
    }
}
