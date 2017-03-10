<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Event;
use AppBundle\Entity\EventType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadEventData
 */
class LoadEventData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $datas = [
            [
                'name' => 'Match Rugby',
                'date' => new \DateTime("2017-12-19 21:00:00"),
                'location' => 'Paris',
            ],
            [
                'name' => 'Match Football',
                'date' => new \DateTime("2017-04-12 22:30:00"),
                'location' => 'Marseille',
            ],
            [
                'name' => 'Match Tennis',
                'date' => new \DateTime("2017-05-23 20:35:00"),
                'location' => 'Lyon',
            ],
            [
                'name' => 'Match HandBall',
                'date' => new \DateTime("2017-12-26 21:00:00"),
                'location' => 'Bordeaux',
            ],
            [
                'name' => 'Match Ping Pong',
                'date' => new \DateTime("2017-09-26 19:00:00"),
                'location' => 'Barcelone',
            ],
            [
                'name' => 'Demi finale Football',
                'date' => new \DateTime("2017-08-01 18:40:00"),
                'location' => 'Madrid',
            ]
        ];

        foreach ($datas as $key => $data) {

            /** @var Event $event */
            $event = new Event();
            $event->setName($data['name']);
            $event->setDate($data['date']);
            $event->setLocation($data['location']);

            /** @var EventType $randEventType */
            $randEventType = $this->getReference('event-type-' . rand(0, 7));
            $event->setEventType($randEventType);

            $this->setReference('event-' . $key, $event);

            $manager->persist($event);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
