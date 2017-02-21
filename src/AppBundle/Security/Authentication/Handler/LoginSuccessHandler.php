<?php
namespace AppBundle\Security\Authentication\Handler;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
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
    private $entityManager;

    /**
     * LoginSuccessHandler constructor.
     *
     * @param Router               $router
     * @param AuthorizationChecker $authorizationChecker
     * @param EntityManager        $entityManager
     */
    public function __construct(
        Router $router,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->router        = $router;
        $this->security      = $authorizationChecker;
        $this->entityManager = $entityManager;
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
        if ($this->security->isGranted(User::USER_ROLE_OBSERVATOR)) {
            $routeName = 'admin_homepage';
        } else {
            $routeName = 'homepage';
        }
        $response = new RedirectResponse($this->router->generate($routeName));

        return $response;
    }
}
