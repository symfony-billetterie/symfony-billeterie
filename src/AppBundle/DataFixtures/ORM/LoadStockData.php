<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Event;
use AppBundle\Entity\Stock;
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
                'quantity'        => 445,
                'initialQuantity' => 445,
                'event'           => 'Match HandBall',
                'ticketCategory'  => 'Gradin',
            ],
            [
                'quantity'        => 1200,
                'initialQuantity' => 1200,
                'event'           => 'Match Tennis',
                'ticketCategory'  => 'Fosse',
            ],
            [
                'quantity'        => 4454,
                'initialQuantity' => 4454,
                'event'           => 'Match Football',
                'ticketCategory'  => 'Gradin',
            ],
            [
                'quantity'        => 5673,
                'initialQuantity' => 5673,
                'event'           => 'Demi finale Football',
                'ticketCategory'  => 'Tribune',
            ],
            [
                'quantity'        => 3400,
                'initialQuantity' => 3400,
                'event'           => 'Match Football',
                'ticketCategory'  => 'Fosse',
            ],
            [
                'quantity'        => 1786,
                'initialQuantity' => 1786,
                'event'           => 'Match Tennis',
                'ticketCategory'  => 'Balcon',
            ],
        ];

        foreach ($datas as $key => $data) {

            /** @var Event $event */
            $stock = new Stock();
            $stock->setQuantity($data['quantity']);
            $stock->setInitialQuantity($data['initialQuantity']);

            /** @var Event $randEvent */
            $event = $this->getReference('event-' . $data['event']);
            $stock->setEvent($event);

            /** @var Event $randEvent */
            $ticketCategory = $this->getReference('ticket-category-' . $data['ticketCategory']);
            $stock->setCategory($ticketCategory);

            $this->setReference('stock-' . $key, $stock);

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
