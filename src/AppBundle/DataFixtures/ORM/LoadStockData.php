<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Event;
use AppBundle\Entity\Stock;
use AppBundle\Entity\TicketCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadStockData
 */
class LoadStockData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            [
                'quantity'        => 10,
                'initialQuantity' => 10,
                'event'           => 'Match HandBall',
                'ticketCategory'  => 'Gradin',
            ],
            [
                'quantity'        => 20,
                'initialQuantity' => 20,
                'event'           => 'Match Tennis',
                'ticketCategory'  => 'Fosse',
            ],
            [
                'quantity'        => 15,
                'initialQuantity' => 15,
                'event'           => 'Match Football',
                'ticketCategory'  => 'Gradin',
            ],
            [
                'quantity'        => 18,
                'initialQuantity' => 18,
                'event'           => 'Demi finale Football',
                'ticketCategory'  => 'Tribune',
            ],
            [
                'quantity'        => 25,
                'initialQuantity' => 25,
                'event'           => 'Match Football',
                'ticketCategory'  => 'Fosse',
            ],
            [
                'quantity'        => 30,
                'initialQuantity' => 30,
                'event'           => 'Match Tennis',
                'ticketCategory'  => 'Balcon',
            ],
            [
                'quantity'        => 5,
                'initialQuantity' => 5,
                'event'           => 'Match Ping Pong',
                'ticketCategory'  => 'Tribune',
            ],
        ];

        foreach ($datas as $key => $data) {

            /** @var TicketCategory $ticketCategory */
            $ticketCategory = $this->getReference('ticket-category-'.$data['ticketCategory']);

            /** @var Event $randEvent */
            $event = $this->getReference('event-'.$data['event']);

            /** @var Event $event */
            $stock = new Stock();
            $stock->setQuantity($data['quantity'])
                ->setInitialQuantity($data['initialQuantity'])
                ->setCategory($ticketCategory)
                ->setEvent($event);

            $this->setReference('stock-'.$key, $stock);

            $manager->persist($stock);
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
