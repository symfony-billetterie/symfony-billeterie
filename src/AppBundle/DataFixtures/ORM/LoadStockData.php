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
                'quantity' => 20,
                'event' => 'Match Ping Pong',
            ],
            [
                'quantity' => 15,
                'event' => 'Match HandBall',
            ],
            [
                'quantity' => 10,
                'event' => 'Match Rugby',
            ],
            [
                'quantity' => 24,
                'event' => 'Match Tennis',
            ],
            [
                'quantity' => 10,
                'event' => 'Match Football',
            ],
            [
                'quantity' => 50,
                'event' => 'Demi finale Football',
            ],
            [
                'quantity' => 12,
                'event' => 'Match Football',
            ],
            [
                'quantity' => 17,
                'event' => 'Match Tennis',
            ]
        ];

        foreach ($datas as $key => $data) {

            /** @var Event $event */
            $stock = new Stock();
            $stock->setQuantity($data['quantity']);

            /** @var Event $randEvent */
            $randEvent = $this->getReference('event-' . $data['event']);
            $stock->setEvent($randEvent);

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
