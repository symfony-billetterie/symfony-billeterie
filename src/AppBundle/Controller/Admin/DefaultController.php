<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\Traits\UtilitiesTrait;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    use UtilitiesTrait;

    /**
     * @Route("/", name="admin_homepage")
     * @Method({"GET"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * Retourne la page d'accueil du Back Office
     */
    public function indexAction(Request $request)
    {
        return $this->render('admin/default/index.html.twig');
    }
}
