<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Form\Type\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use AppBundle\Controller\Traits\UtilitiesTrait;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArticleController
 *
 * @Route("/actualites")
 */
class ArticleController extends Controller
{
    use UtilitiesTrait;

    /**
     * Liste des actualités
     *
     * @Route("/", name="admin_article_index")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function indexAction()
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();

        return $this->render('admin/article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Ajout d'une actualité
     *
     * @Route("/ajouter", name="admin_article_add")
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addAction(Request $request)
    {
        /** @var Article $article */
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($article);
                $em->flush();
                $this->addFlash('success', 'flash.admin.article.add.success');

                return $this->redirectToRoute('admin_article_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'flash.admin.article.add.danger');
            }
        }

        return $this->render('admin/article/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modification d'une actualité
     *
     * @param Request $request
     * @param string  $slug
     *
     * @return Response
     *
     * @Route("/editer/{slug}", name="admin_article_edit")
     * @Method({"POST"})
     */
    public function editAction(Request $request, string $slug)
    {
        $em = $this->getDoctrine();

        /** @var Article $article */
        $article = $em->getRepository('AppBundle:Article')->findOneBy(['slug' => $slug]);
        $form    = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->getManager()->persist($article);
                $em->getManager()->flush();
                $this->addFlash('success', 'flash.admin.article.edit.success');

                return $this->redirectToRoute('admin_article_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'flash.admin.article.edit.danger');
            }
        }

        return $this->render('admin/article/edit.html.twig', [
            'form'    => $form->createView(),
            'article' => $article,
        ]);
    }

    /**
     * Suppression d'une actualité
     *
     * @Route("/supprimer/{slug}", name="admin_article_delete")
     * @Method({"POST"})
     * @param string $slug
     *
     * @return RedirectResponse
     */
    public function deleteAction(string $slug)
    {
        $em      = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->findOneBy(['slug' => $slug]);
        $em->remove($article);
        try {
            $em->flush();
            $this->addFlash('success', 'flash.admin.article.delete.success');
        } catch (\Exception $e) {
            $this->addFlash('danger', 'flash.admin.article.delete.danger');
        }

        return $this->redirectToRoute('admin_article_index');
    }
}
