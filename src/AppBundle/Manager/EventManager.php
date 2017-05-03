<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Article;
use AppBundle\Entity\Event;
use AppBundle\Entity\Stock;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class EventManager
 */
class EventManager
{
    private $em;

    /**
     * EventManager constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em           = $em;
    }

    /**
     * @return Article[]|array|PaginatorInterface
     */
    public function createEvent()
    {
        /** @var Event $event */
        $event = new Event();

        $categories = $this->em->getRepository('AppBundle:TicketCategory')->findAll();

        foreach ($categories as $category) {
            $stock = new Stock();
            $stock->setCategory($category);
            $stock->setEvent($event);
            $stock->setQuantity(0);
            $event->addStock($stock);
        }

        return $event;
    }
}
