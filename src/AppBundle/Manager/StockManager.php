<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Booking;
use AppBundle\Entity\Event;
use AppBundle\Entity\TicketCategory;
use AppBundle\Form\Type\TicketType;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class StockManager
 */
class StockManager
{
    private $request;
    private $knpPaginator;
    private $em;

    /**
     * StockManager constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Event          $event
     * @param TicketCategory $ticketCategory
     * @param int            $countTicket
     *
     * @return bool
     */
    public function manageStock(Event $event, TicketCategory $ticketCategory, int $countTicket)
    {
        $stock      = $this->em->getRepository('AppBundle:Stock')->findOneBy(
            [
                'event'    => $event->getId(),
                'category' => $ticketCategory->getId(),
            ]
        );
        $countStock = $stock->getQuantity();

        dump($countTicket);
        dump($countStock);
        dump($countTicket > $countStock);
        // Insufficient stock
        if ($countTicket > $countStock) {
            return false;
        } else {
            $stock->setQuantity($countStock - $countTicket);
            $this->em->flush();

            return true;
        }
    }
}
