<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Traits\UtilitiesTrait;
use AppBundle\Entity\TicketCategory;
use AppBundle\Form\Type\TicketCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TicketCategoryController
 *
 * @Route("/type-categorie")
 */
class TicketCategoryController extends Controller
{
    use UtilitiesTrait;

    /**
     * lister des catégories de tickets
     *
     * @Route("/", name="admin_ticket_category_index")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        //On va chercher toutes les categories de ticket
        $ticketCategories = $this->getDoctrine()->getRepository('AppBundle:TicketCategory')->findAll();

        return $this->render('admin/ticket_category/index.html.twig', [
            'ticketCategories' => $ticketCategories,
        ]);
    }

    /**
     * Ajouter une catégorie de tickets
     *
     * @Route("/ajouter", name="admin_ticket_category_add")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addAction(Request $request): Response
    {
        /** @var TicketCategory $ticketCategory */
        $ticketCategory = new TicketCategory();
        $em             = $this->getDoctrine()->getManager();

        $form = $this->createForm(TicketCategoryType::class, $ticketCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->persist($ticketCategory);
                $em->flush();
                $this->get('app.manager.log')->logAction(
                    'log.ticket_category.add.title',
                    'log.ticket_category.add.message',
                    $this->getUser()
                );
                $this->addFlash('success', 'flash.admin.ticket_category.add.success');

                return $this->redirectToRoute('admin_ticket_category_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'flash.admin.ticket_category.add.danger');
            }
        }

        return $this->render('admin/ticket_category/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modifier une catégorie de tickets
     *
     * @Route("/editer/{slug}", name="admin_ticket_category_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param string  $slug
     *
     * @return Response
     */
    public function editAction(Request $request, string $slug): Response
    {
        $em = $this->getDoctrine()->getManager();
        /** @var TicketCategory $ticketCategory */
        $ticketCategory = $em->getRepository('AppBundle:TicketCategory')->findOneBy(['slug' => $slug]);

        $form = $this->createForm(TicketCategoryType::class, $ticketCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->persist($ticketCategory);
                $em->flush();
                $this->get('app.manager.log')->logAction(
                    'log.ticket_category.edit.title',
                    'log.ticket_category.edit.message',
                    $this->getUser()
                );
                $this->addFlash('success', 'flash.admin.ticket_category.edit.success');

                return $this->redirectToRoute('admin_ticket_category_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'flash.admin.ticket_category.edit.danger');
            }
        }

        return $this->render('admin/ticket_category/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprimer une catégorie de ticket
     *
     * @Route("/supprimer/{slug}", name="admin_ticket_category_delete")
     * @Method({"GET", "POST"})
     *
     * @param string $slug
     *
     * @return RedirectResponse
     */
    public function deleteAction(string $slug)
    {
        $em             = $this->getDoctrine()->getManager();
        $ticketCategory = $em->getRepository('AppBundle:TicketCategory')->findOneBy(['slug' => $slug]);
        $em->remove($ticketCategory);
        try {
            $em->flush();
            $this->get('app.manager.log')->logAction(
                'log.ticket_category.remove.title',
                'log.ticket_category.remove.message',
                $this->getUser()
            );
            $this->addFlash('success', 'flash.admin.ticket_category.delete.success');
        } catch (\Exception $e) {
            $this->addFlash('danger', 'flash.admin.ticket_category.delete.danger');
        }

        return $this->redirectToRoute('admin_ticket_category_index');
    }
}
