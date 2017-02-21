<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET"})
     *
     * @return Response
     *
     * Retourne la page d'accueil du Front Office
     */
    public function indexAction()
    {
        return $this->render('app/default/index.html.twig');
    }
}
