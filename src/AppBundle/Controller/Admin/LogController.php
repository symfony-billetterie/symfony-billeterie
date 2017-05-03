<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\Traits\UtilitiesTrait;

/**
 * Class LogController
 *
 * @Route("/log")
 */
class LogController extends Controller
{
    use UtilitiesTrait;

    /**
     * @Route("/", name="admin_log_index")
     * @Method({"GET"})
     *
     * @return Response
     *
     * Retourne la page d'index des logs du Back Office
     */
    public function indexAction()
    {
        $logs = $this->getDoctrine()->getRepository('AppBundle:Log')->findBy([], ['id' => 'DESC']);

        return $this->render('admin/log/index.html.twig', [
            'logs' => $logs,
        ]);
    }
}
