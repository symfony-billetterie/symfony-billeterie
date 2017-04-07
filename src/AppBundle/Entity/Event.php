<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity()
 */
class Event
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var EventType
     *
     * @ORM\ManyToOne(targetEntity="EventType", inversedBy="events")
     * @ORM\JoinColumn(name="event_type_id", referencedColumnName="id")
     */
    private $eventType;

    /**
     * @var Stock[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="event", cascade={"persist"})
     */
    private $stocks;

    /**
     * @var Booking[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="event")
     */
    private $bookings;

    /**
     * @Gedmo\Slug(fields={"name"}, separator="-", updatable=true, unique=true)
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->stocks   = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Event
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set eventType
     *
     * @param string $eventType
     *
     * @return Event
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * Get eventType
     *
     * @return EventType
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @param $stock
     *
     * @return Event
     */
    public function addStock($stock)
    {
        $this->stocks[] = $stock;

        return $this;
    }

    /**
     * Set stock
     *
     * @param string $stocks
     *
     * @return Event
     */
    public function setStocks($stocks)
    {
        $this->stocks = $stocks;

        return $this;
    }

    /**
     * Get stock
     *
     * @return Stock[]|ArrayCollection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * @return mixed
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @param mixed $bookings
     *
     * @return Event
     */
    public function setBookings($bookings)
    {
        $this->bookings = $bookings;

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
     * @param mixed $slug
     *
     * @return Event
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
