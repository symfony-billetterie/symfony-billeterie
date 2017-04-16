<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     * Retourne la liste des actualités
     */
    public function indexAction()
    {
        $articles = $this->get('app.manager.article')->listArticle();

        return $this->render('app/default/index.html.twig', ['articles' => $articles]);
    }
}
