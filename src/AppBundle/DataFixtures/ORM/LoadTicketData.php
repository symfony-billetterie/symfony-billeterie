<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Ticket;
use AppBundle\Entity\Event;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadTicketData
 *
 * jeu d'essai des tickets
 */
class LoadTicketData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            [
                'distributed'     => 0,
                'door'            => 1,
                'floor'           => 1,
                'number'          => 321412,
                'user'            => 'beneficiary@gmail.com',
                'event'           => 'Match Rugby',
                'ticket_category' => 'Fosse',
            ],
            [
                'distributed'     => 0,
                'door'            => 1,
                'floor'           => 1,
                'number'          => 321412,
                'user'            => 'beneficiary@gmail.com',
                'event'           => 'Match Tennis',
                'ticket_category' => 'Gradin',
            ],
            [
                'distributed'     => 0,
                'door'            => 1,
                'floor'           => 1,
                'number'          => 321412,
                'user'            => 'beneficiary@gmail.com',
                'event'           => 'Match HandBall',
                'ticket_category' => 'Gradin',
            ],
            [
                'distributed'     => 0,
                'door'            => 1,
                'floor'           => 1,
                'number'          => 321412,
                'user'            => 'beneficiary@gmail.com',
                'event'           => 'Match HandBall',
                'ticket_category' => 'Tribune',
            ],
        ];

        foreach ($data as $value) {
            /** @var Ticket $ticket */
            $ticket = new Ticket();
            $ticket->setDistributed($value['distributed']);
            $ticket->setDoor($value['door']);
            $ticket->setFloor($value['floor']);
            $ticket->setNumber($value['number']);
            $ticket->setUser($this->getReference('user-'.$value['user']));
            $ticket->setBooking($this->getReference('booking-'.$value['event'].$value['ticket_category']));

            $manager->persist($ticket);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 3;
    }
}
