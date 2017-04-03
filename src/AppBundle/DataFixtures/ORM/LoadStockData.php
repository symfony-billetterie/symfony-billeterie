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
                'quantity' => 445,
                'event' => 'Match HandBall',
            ],
            [
                'quantity' => 1200,
                'event' => 'Match Tennis',
            ],
            [
                'quantity' => 4454,
                'event' => 'Match Football',
            ],
            [
                'quantity' => 5673,
                'event' => 'Demi finale Football',
            ],
            [
                'quantity' => 3400,
                'event' => 'Match Football',
            ],
            [
                'quantity' => 1786,
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
