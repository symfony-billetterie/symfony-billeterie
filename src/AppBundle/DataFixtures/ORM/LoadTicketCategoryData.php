<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\TicketCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadTicketCategoryData
 *
 * jeu d'essai des categories de tickets
 */
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

        foreach ($data as $item => $value) {
            /** @var $ticketCategory $ticketCategory */
            $ticketCategory = new TicketCategory();
            $ticketCategory->setLabel($value);
            $manager->persist($ticketCategory);
            $this->setReference('ticket-category-'.$value, $ticketCategory);
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
