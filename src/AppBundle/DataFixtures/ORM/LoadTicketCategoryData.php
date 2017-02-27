<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\TicketCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTicketCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $data = array(
            'Gradin',
            'Balcon',
            'Tribune',
            'Fosse',
        );

        foreach ($data as $item => $value) {
            $ticketCategory = new TicketCategory();
            $ticketCategory->setLabel($value);
            $manager->persist($ticketCategory);
            $this->setReference('TicketCategory-' . $ticketCategory, $value);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 0;
    }
}
