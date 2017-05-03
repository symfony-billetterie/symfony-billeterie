<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Booking;
use AppBundle\Entity\Event;
use AppBundle\Entity\TicketCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadBookingData
 */
class LoadBookingData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            [
                'event'           => 'Match Rugby',
                'ticket_category' => 'Gradin',
                'main_user'       => 'beneficiary@gmail.com',
                'distributed'     => 1,
            ],
            [
                'event'           => 'Match Tennis',
                'ticket_category' => 'Tribune',
                'main_user'       => 'beneficiary@gmail.com',
                'distributed'     => 0,
            ],
            [
                'event'           => 'Match HandBall',
                'ticket_category' => 'Gradin',
                'main_user'       => 'agent@gmail.com',
                'distributed'     => 0,
            ],
            [
                'event'           => 'Match HandBall',
                'ticket_category' => 'Tribune',
                'main_user'       => 'agent@gmail.com',
                'distributed'     => 1,
            ],
        ];

        foreach ($data as $value) {
            /** @var Event $event */
            $event = $this->getReference('event-'.$value['event']);
            /** @var TicketCategory $ticketCategory */
            $ticketCategory = $this->getReference('ticket-category-'.$value['ticket_category']);
            /** @var  $booking */
            $booking = new Booking();
            $booking->setEvent($event);
            $booking->setTicketCategory($ticketCategory);
            $booking->setMainUser($this->getReference('user-'.$value['main_user']));
            $booking->setDistributed($value['distributed']);

            $manager->persist($booking);
            $this->setReference('booking-'.$value['event'].$value['ticket_category'], $booking);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
