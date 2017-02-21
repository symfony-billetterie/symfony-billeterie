<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Log;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class LogManager
 */
class LogManager
{
    private $em;
    private $translator;

    /**
     * LogService constructor.
     *
     * @param EntityManager       $em
     * @param TranslatorInterface $translator
     */
    public function __construct(EntityManager $em, TranslatorInterface $translator)
    {
        $this->em         = $em;
        $this->translator = $translator;
    }

    /**
     * @param string $type
     * @param string $message
     * @param        $user
     */
    public function logAction(string $type, string $message, $user)
    {
        /** @var Log $log */
        $log = new Log();
        $log->setType($type)
            ->setUser($this->translator->trans($message))
            ->setMessage($user);
        $this->em->persist($log);
    }
}
