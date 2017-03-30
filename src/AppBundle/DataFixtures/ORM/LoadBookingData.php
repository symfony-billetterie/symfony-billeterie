<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Booking;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBookingData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $data = array(
            [
                'event' => 'Match Rugby',
                'ticket_category' => 'Gradin',
                'main_user' => 'beneficiary@gmail.com',
            ],
            [
                'event' => 'Match Tennis',
                'ticket_category' => 'Tribune',
                'main_user' => 'beneficiary@gmail.com',
            ],
            [
                'event' => 'Match HandBall',
                'ticket_category' => 'Gradin',
                'main_user' => 'agent@gmail.com',
            ],
            [
                'event' => 'Match HandBall',
                'ticket_category' => 'Tribune',
                'main_user' => 'agent@gmail.com',
            ]
        );

        foreach ($data as $value) {
            /** @var  $booking */
            $booking = new Booking();
            $booking->setEvent($this->getReference('event-' . $value['event']));
            $booking->setTicketCategory($this->getReference('ticket-category-' . $value['ticket_category']));
            $booking->setMainUser($this->getReference('user-' . $value['main_user']));

            $manager->persist($booking);
            $this->setReference('booking-' . $value['event'] . $value['ticket_category'], $booking);
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
