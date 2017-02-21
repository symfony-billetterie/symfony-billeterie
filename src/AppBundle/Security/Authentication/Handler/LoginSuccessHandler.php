<?php
namespace AppBundle\Security\Authentication\Handler;

use AppBundle\Entity\Log;
use AppBundle\Entity\User;
use AppBundle\Manager\LogManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

/**
 * Class LoginSuccessHandler
 */
class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $router;
    private $security;
    private $logManager;

    /**
     * LoginSuccessHandler constructor.
     *
     * @param Router               $router
     * @param AuthorizationChecker $authorizationChecker
     * @param LogManager           $logManager
     */
    public function __construct(
        Router $router,
        AuthorizationChecker $authorizationChecker,
        LogManager $logManager
    ) {
        $this->router     = $router;
        $this->security   = $authorizationChecker;
        $this->logManager = $logManager;
    }

    /**
     * @param Request        $request
     * @param TokenInterface $token
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if (!empty($securityLogin)) {
            $request->getSession()->remove('login');
        }
        if ($this->security->isGranted(User::USER_ROLE_OBSERVATORY)) {
            $routeName = 'admin_homepage';
        } else {
            $routeName = 'homepage';
        }
        $this->logManager->logAction('log.user.login.title', 'log.user.login.message', $token->getUser());
        $response = new RedirectResponse($this->router->generate($routeName));

        return $response;
    }
}
