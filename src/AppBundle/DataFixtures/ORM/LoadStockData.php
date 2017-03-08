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
            ],
            [
                'quantity' => 1200,
            ],
            [
                'quantity' => 4454,
            ],
            [
                'quantity' => 5673,
            ],
            [
                'quantity' => 3400,
            ],
            [
                'quantity' => 1786,
            ]
        ];

        foreach ($datas as $key => $data) {

            /** @var Event $event */
            $stock = new Stock();
            $stock->setQuantity($data['quantity']);

            /** @var Event $randEvent */
            $randEvent = $this->getReference('event-' . rand(0, 5));
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
