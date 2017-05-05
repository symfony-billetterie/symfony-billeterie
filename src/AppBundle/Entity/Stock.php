<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity()
 */
class Stock
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
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $initialQuantity;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="stocks", cascade={"remove"})
     */
    private $event;

    /**
     * @var TicketCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TicketCategory", inversedBy="stocks", cascade={"remove"})
     */
    private $category;

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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Stock
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set event
     *
     * @param string $event
     *
     * @return Stock
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Get category
     *
     * @return TicketCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param TicketCategory $category
     *
     * @return Stock
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return int
     */
    public function getInitialQuantity()
    {
        return $this->initialQuantity;
    }

    /**
     * @param int $initialQuantity
     *
     * @return Stock
     */
    public function setInitialQuantity($initialQuantity)
    {
        $this->initialQuantity = $initialQuantity;

        if (null === $this->quantity) {
            $this->quantity = $initialQuantity;
        }

        return $this;
    }
}
