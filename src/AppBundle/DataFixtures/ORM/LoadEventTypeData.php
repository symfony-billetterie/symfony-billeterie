<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\EventType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadEventTypeData
 */
class LoadEventTypeData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            [
                'name' => 'Handball',
            ],
            [
                'name' => 'Football',
            ],
            [
                'name' => 'Basket Ball',
            ],
            [
                'name' => 'Tennis',
            ],
            [
                'name' => 'Ski',
            ],
            [
                'name' => 'Natation',
            ],
            [
                'name' => 'Ping Pong',
            ],
            [
                'name' => 'Volley Ball',
            ],
        ];

        foreach ($datas as $data) {
            /** @var EventType $eventType */
            $eventType = new EventType();
            $eventType->setName($data['name']);

            $manager->persist($eventType);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 0;
    }
}
