<?php

namespace AppBundle\Repository;

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
            ->orderBy('e.id', 'DESC')
            ->getQuery()->getResult();
    }
}
