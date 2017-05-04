<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use Doctrine\ORM\EntityRepository;

/**
 * Class BookingRepository
 */
class BookingRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findForExport()
    {
        return $this->createQueryBuilder('b')
            ->join('b.event', 'e')
            ->join('b.mainUser', 'u')
            ->leftJoin('b.secondaryUsers', 'su')
            ->orderBy('e.id', 'DESC')
            ->getQuery()->getResult();
    }

    /**
     * @param bool  $isDistributed
     * @param Event $event
     *
     * @return int
     */
    public function findBookingNumber(bool $isDistributed, Event $event)
    {
        return $this->createQueryBuilder('b')
            ->select('COUNT(b.id)')
            ->join('b.event', 'e', 'WITH', 'e.id = :event')
            ->setParameter('event', $event->getId())
            ->getQuery()->getSingleScalarResult();
    }
}
