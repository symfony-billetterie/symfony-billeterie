<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUserData
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{

    private $users = [
        [
            'role'      => User::USER_ROLE_SUPER_ADMIN,
            'civility'  => User::USER_CIVILITY_MAN,
            'firstName' => 'Martin',
            'lastName'  => 'Dulat',
            'address'   => '12 rue de la république',
            'zipCode'   => '60300',
            'city'      => 'Senlis',
            'phone'     => '0612345678',
            'idNumber'  => '8984251',
            'email'     => 'admin@gmail.com',
            'password'  => '1234',
            'enabled'   => true,
        ],
        [
            'role'      => User::USER_ROLE_OBSERVATORY,
            'civility'  => User::USER_CIVILITY_MAN,
            'firstName' => 'Fred',
            'lastName'  => 'Genouvrier',
            'address'   => 'rue de l\'arc de triomphe',
            'zipCode'   => '75000',
            'city'      => 'Paris',
            'phone'     => '0634567891',
            'idNumber'  => '88738777',
            'email'     => 'observatory@gmail.com',
            'password'  => '1234',
            'enabled'   => true,
        ],
        [
            'role'      => User::USER_ROLE_AGENT,
            'civility'  => User::USER_CIVILITY_WOMAN,
            'firstName' => 'Julie',
            'lastName'  => 'Giry',
            'address'   => '32, rue de l\'apport au pain',
            'zipCode'   => '34000',
            'city'      => 'Montpellier',
            'phone'     => '0645612378',
            'idNumber'  => '5138744',
            'email'     => 'agent@gmail.com',
            'password'  => '1234',
            'enabled'   => true,
        ],
        [
            'role'      => User::USER_ROLE_BENEFICIARY,
            'civility'  => User::USER_CIVILITY_WOMAN,
            'firstName' => 'Agnès',
            'lastName'  => 'Sirven',
            'address'   => '8, rue Descartes ',
            'zipCode'   => '67200',
            'city'      => 'Strasbourg',
            'phone'     => '0612678345',
            'idNumber'  => '02483148',
            'email'     => 'beneficiary@gmail.com',
            'password'  => '1234',
            'enabled'   => true,
        ],
    ];

    /**
     * @param ObjectManager $manager
     * insérer en bdd le jeu d'essai des utilisateurs
     */
    public function load(ObjectManager $manager)
    {
        $now = new \DateTime();
        foreach ($this->users as $user) {
            /** @var User $thisUser */
            $thisUser = new User();
            $thisUser->addRole($user['role'])
                ->setCivility($user['civility'])
                ->setBirthdayDate($now->sub(new \DateInterval('P30Y')))
                ->setFirstName($user['firstName'])
                ->setLastName($user['lastName'])
                ->setAddress($user['address'])
                ->setZipCode($user['zipCode'])
                ->setCity($user['city'])
                ->setPhone($user['phone'])
                ->setIdNumber($user['idNumber'])
                ->setEmail($user['email'])
                ->setUsername($user['email'])
                ->setPlainPassword($user['password'])
                ->setEnabled($user['enabled']);
            $manager->persist($thisUser);
            $this->setReference('user-' . $user['email'], $thisUser);
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
