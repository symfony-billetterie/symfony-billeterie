<?php
namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

/**
 * Class AccessDeniedHandler
 */
class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    /**
     * @param Request               $request
     * @param AccessDeniedException $accessDeniedException
     *
     * @return Response
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        return new Response('Access Denied', 403);
    }
}