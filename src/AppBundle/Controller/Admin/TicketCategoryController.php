<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\TicketCategory;
use AppBundle\Form\Type\TicketCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Class TicketCategoryController
 *
 * @Route("/type-category")
 */
class TicketCategoryController extends Controller
{
    /**
     * lister des catégories de tickets
     *
     * @Route("/", name="admin_ticket_category_index")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        //On va chercher toutes les categories de ticket
        $ticketCategories = $this->getDoctrine()->getRepository('AppBundle:TicketCategory')->findAll();

        return $this->render('admin:ticket_category:index.html.twig', [
            'ticketCategory' => $ticketCategories,
        ]);
    }

    /**
     * Ajouter une catégorie de tickets
     *
     * @Route("/ajouter", name="admin_ticket_category_add")
     *
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request): Response
    {
        /** @var TicketCategory $ticketCategory */
        $ticketCategory = new TicketCategory();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(TicketCategoryType::class, $ticketCategory);
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ticketCategory);
            $em->flush();
        }

        return $this->render('admin:ticket_category:edit.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * Modifier une catégorie de tickets
     *
     * @Route("/editer/{slug}", name="admin_category_ticket_edit")
     *
     * @param Request $request
     * @param string $slug
     * @return Response
     */
    public function editAction(Request $request, string $slug): Response
    {
        $em = $this->getDoctrine()->getManager();
        $ticketCategory = $em->getRepository('AppBundle:TicketCategory')->findOneBySlug($slug);

        $form = $this->createForm(TicketCategoryType::class, $ticketCategory);
        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ticketCategory);
            $em->flush();
        }

        return $this->render('admin:ticket_category:edit.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * Supprimer une catégorie de ticket
     *
     * @Route("/supprimer/{slug}", name="admin_category_ticket_delete")
     *
     * @param Request $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, string $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $ticketCategory = $em->getRepository('AppBundle:TicketCategory')->findOneBySlug($slug);
        $em->remove($ticketCategory);
        try {
            $em->flush();
            $this->addFlash('success', 'flash.admin.category_ticket.success');
        } catch (\Exception $e) {
            $this->addFlash('danger', 'flash.admin.ticket_category.danger');
        }
    }
}
