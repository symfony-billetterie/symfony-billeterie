<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\TicketCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTicketCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            'Gradin',
            'Balcon',
            'Tribune',
            'Fosse',
        ];

        /**
         * jeu d'essai des categories de tickets
         */
        foreach ($data as $item => $value) {
            $ticketCategory = new TicketCategory();
            $ticketCategory->setLabel($value);
            $manager->persist($ticketCategory);
            $this->setReference('ticket-category-' . $value, $ticketCategory);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 0;
    }
}
