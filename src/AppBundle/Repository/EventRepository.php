<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use Doctrine\ORM\EntityRepository;

/**
 * Class EventRepository
 */
class EventRepository extends EntityRepository
{
    /**
     * @param Event $event
     *
     * @return int
     */
    public function findRemainingPlaces(Event $event)
    {
        $bookingNumber = $this->createQueryBuilder('e')
            ->select('COUNT(su.id)+1')
            ->join('e.bookings', 'b')
            ->leftJoin('b.secondaryUsers', 'su')
            ->where('e.id = :event')
            ->setParameter('event', $event->getId())
            ->getQuery()->getSingleScalarResult();

        return $this->createQueryBuilder('ev')
            ->select('SUM(s.quantity) - :bookingNumber')
            ->join('ev.stocks', 's')
            ->where('ev.id = :event')
            ->setParameter('event', $event->getId())
            ->setParameter('bookingNumber', $bookingNumber)
            ->getQuery()->getSingleScalarResult();
    }

    /**
     * @return array
     */
    public function findLastEvents()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.id','DESC')
            ->setMaxResults(5)
            ->getQuery()->getResult();
    }
}
