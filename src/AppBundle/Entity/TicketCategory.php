<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class TicketCategory
 *
 * @ORM\Entity
 * @ORM\Table(name="ticket_category")
 */
class TicketCategory
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $label;

    /**
     * @Gedmo\Slug(fields={"label"}, separator="-", updatable=true, unique=true)
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @var Stock[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="category", cascade={"remove"})
     */
    private $stocks;

    /**
     * @var Booking[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="ticketCategory", cascade={"remove"})
     */
    private $bookings;

    /**
     * TicketCategory constructor.
     */
    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->stocks   = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param null|string $label
     *
     * @return TicketCategory|null
     */
    public function setLabel(?string $label): ?TicketCategory
    {
        $this->label = $label;

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
     * @return Stock[]|ArrayCollection
     */
    public function getStocks()
    {
        return $this->stocks;
    }
    
    /**
     * @param Stock[]|ArrayCollection $stocks
     */
    public function setStocks($stocks)
    {
        $this->stocks = $stocks;
    }
    
    /**
     * @return Booking[]|ArrayCollection
     */
    public function getBookings()
    {
        return $this->bookings;
    }
    
    /**
     * @param Booking[]|ArrayCollection $bookings
     */
    public function setBookings($bookings)
    {
        $this->bookings = $bookings;
    }
}
