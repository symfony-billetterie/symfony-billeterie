<?php
namespace AppBundle\Security\Logout\Handler;

use AppBundle\Manager\LogManager;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LogoutHandler
 */
class LogoutHandler implements LogoutHandlerInterface
{
    private $logManager;

    /**
     * LogoutHandler constructor.
     *
     * @param LogManager $logManager
     */
    public function __construct(
        LogManager $logManager
    ) {
        $this->logManager = $logManager;
    }

    /**
     * @param Request        $request
     * @param Response       $response
     * @param TokenInterface $authToken
     *
     * @return Response
     */
    public function logout(Request $request, Response $response, TokenInterface $authToken)
    {
        $this->logManager->logAction('log.user.logout.title', 'log.user.logout.message', $authToken->getUser());

        return $response;
    }
}
