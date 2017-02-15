<?php

namespace AppBundle\DataFixtures\ORM;

/**
 * Class LoadUserData
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * insérer en bdd le jeu d'essai des utilisateurs
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('admin');
        $manager->persist($userAdmin);
        $manager->flush();
    }
}
