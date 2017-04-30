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
    public function manageStock(
        bool $delete,
        int $oldCountTicket = null,
        Event $event,
        TicketCategory $ticketCategory,
        int $countTicket
    ) {
        $stock = $this->em->getRepository('AppBundle:Stock')->findOneBy(
            [
                'event'    => $event->getId(),
                'category' => $ticketCategory->getId(),
            ]
        );
        if ($stock) {
            $countStock = $stock->getQuantity();
            // If deleting booking
            if ($delete) {
                $stock->setQuantity($countStock + $countTicket);
                $this->em->flush($stock);

                return false;
            } else if ($oldCountTicket) {
                // Déduire nouveaux tickets du stock
                $newTickets = $countTicket - $oldCountTicket;
                $stock->setQuantity($countStock - $newTickets);
                $this->em->flush($stock);
            } else {

                // Insufficient stock
                if ($countTicket > $countStock) {
                    return false;
                } else {
                    $stock->setQuantity($countStock - $countTicket);
                    $this->em->flush($stock);

                    return true;
                }
            }
        } else {
            Throw New \LogicException('No stock');
        }
    }
}
