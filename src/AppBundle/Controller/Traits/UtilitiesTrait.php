<?php

namespace AppBundle\Controller\Traits;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface as User;

/**
 * Class UtilitiesTrait
 *
 * @package AppBundle\Controller\Traits
 */
trait UtilitiesTrait
{
    /**
     * @param bool $strict
     */
    public function getUser($strict = true)
    {
        $user = $this->doGetUser();
        if ($strict && !$user instanceof User) {
            throw new AccessDeniedException('User must be logged in.');
        }

        return $user;
    }

    /**
     * @return null
     */
    protected function doGetUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return null;
        }

        if (!is_object($user = $token->getUser())) {
            return null;
        }

        return $user;
    }

    /**
     * @param       $type
     * @param       $message
     * @param bool  $translate
     * @param array $parameters
     * @param null  $translationDomain
     *
     * Créer un flash message avec le type de flash et le message à translate
     */
    public function addFlash(
        $type,
        $message,
        $translate = true,
        array $parameters = [],
        $translationDomain = null
    ) {
        if ($translate) {
            $message = $this->container->get('translator')->trans($message, $parameters, $translationDomain);
        }
        $this->container->get('session')->getFlashBag()->add($type, $message);
    }
}
