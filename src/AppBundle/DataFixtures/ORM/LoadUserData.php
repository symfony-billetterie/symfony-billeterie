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
            'civility'  => 'Mr',
            'firstName' => 'Martin',
            'lastName'  => 'Dulat',
            'address'   => '12 rue de la république',
            'zipCode'   => '60300',
            'city'      => 'Senlis',
            'phone'     => '0612345678',
            'idCard'    => '4476714',
            'idNumber'  => '8984251',
            'email'     => 'admin@gmail.com',
            'username'  => 'admin',
            'password'  => '1234',
            'enabled'   => true,
        ],
        [
            'role'      => User::USER_ROLE_OBSERVATORY,
            'civility'  => 'Mr',
            'firstName' => 'Fred',
            'lastName'  => 'Genouvrier',
            'address'   => 'rue de l\'arc de triomphe',
            'zipCode'   => '75000',
            'city'      => 'Paris',
            'phone'     => '0634567891',
            'idCard'    => '9875125',
            'idNumber'  => '88738777',
            'email'     => 'observatory@gmail.com',
            'username'  => 'observatory',
            'password'  => '1234',
            'enabled'   => true,
        ],
        [
            'role'      => User::USER_ROLE_AGENT,
            'civility'  => 'Mr',
            'firstName' => 'Julie',
            'lastName'  => 'Giry',
            'address'   => '32, rue de l\'apport au pain',
            'zipCode'   => '34000',
            'city'      => 'Montpellier',
            'phone'     => '0645612378',
            'idCard'    => '1874622',
            'idNumber'  => '5138744',
            'email'     => 'agent@gmail.com',
            'username'  => 'agent',
            'password'  => '1234',
            'enabled'   => true,
        ],
        [
            'role'      => User::USER_ROLE_BENEFICIARY,
            'civility'  => 'Mr',
            'firstName' => 'Agnès',
            'lastName'  => 'Sirven',
            'address'   => '8, rue Descartes ',
            'zipCode'   => '67200',
            'city'      => 'Strasbourg',
            'phone'     => '0612678345',
            'idCard'    => '41876300',
            'idNumber'  => '02483148',
            'email'     => 'beneficiary@gmail.com',
            'username'  => 'beneficiary',
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
                ->setlastName($user['lastName'])
                ->setAddress($user['address'])
                ->setZipCode($user['zipCode'])
                ->setCity($user['city'])
                ->setPhone($user['phone'])
                ->setIdCard($user['idCard'])
                ->setIdNumber($user['idNumber'])
                ->setEmail($user['email'])
                ->setUsername($user['username'])
                ->setPlainPassword($user['password'])
                ->setEnabled($user['enabled']);
            $manager->persist($thisUser);
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
