<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Traits\UtilitiesTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class AuthController
 */
class AuthController extends Controller
{
    use UtilitiesTrait;

    /**
     * @param Request $request
     *
     * @return Response
     * @Route("/auth/login", name="auth_login")
     * @Method({"PUT"})
     */
    public function loginAction(Request $request)
    {
        /** @var Session $session */
        $session         = $request->getSession();
        $authErrorKey    = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }
        if (!$error instanceof AuthenticationException) {
            $error = null;
        }

        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);
        $csrfToken    = $this->has('security.csrf.token_manager') ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue() : null;

        return $this->render('app/auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token'    => $csrfToken,
        ]);
    }
}
