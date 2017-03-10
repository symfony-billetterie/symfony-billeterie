<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\EventType;
use AppBundle\Form\Type\EventTypeType;
use AppBundle\Controller\Traits\UtilitiesTrait;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EventTypeController
 *
 * @Route("/type-evenement")
 */
class EventTypeController extends Controller
{
    use UtilitiesTrait;

    /**
     * Liste des types d'événement
     *
     * @Route("/", name="admin_event_type_index")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function indexAction()
    {
        $eventTypes = $this->getDoctrine()->getRepository('AppBundle:EventType')->findAll();

        return $this->render('admin/event_type/index.html.twig', [
            'eventTypes' => $eventTypes,
        ]);
    }

    /**
     * Ajout d'un type d'événement
     *
     * @Route("/ajouter", name="admin_event_type_add")
     * @param Request $request
     *
     * @return Response
     */
    public function addAction(Request $request)
    {
        /** @var EventType $eventType */
        $eventType = new EventType();

        $form = $this->createForm(EventTypeType::class, $eventType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($eventType);
                $em->flush();
                $this->addFlash('success', 'flash.admin.event_type.add.success');

                return $this->redirectToRoute('admin_event_type_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'flash.admin.event_type.add.danger');
            }
        }

        return $this->render('admin/event_type/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modification d'un type d'événement
     *
     * @param Request $request
     * @param string  $slug
     *
     * @return Response
     *
     * @Route("/editer/{slug}", name="admin_event_type_edit")
     */
    public function editAction(Request $request, string $slug)
    {
        $em = $this->getDoctrine();

        /** @var EventType $eventType */
        $eventType = $em->getRepository('AppBundle:EventType')->findOneBy(['slug' => $slug]);
        $form      = $this->createForm(EventTypeType::class, $eventType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->getManager()->persist($eventType);
                $em->getManager()->flush();
                $this->addFlash('success', 'flash.admin.event_type.edit.success');

                return $this->redirectToRoute('admin_event_type_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'flash.admin.event_type.edit.danger');
            }
        }

        return $this->render('admin/event_type/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Suppression d'un type d'événement
     *
     * @Route("/supprimer/{eventType}", name="admin_event_type_delete")
     * @param EventType $eventType
     *
     * @return RedirectResponse
     */
    public function deleteAction(EventType $eventType)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($eventType);
        try {
            $em->flush();
            $this->addFlash('success', 'flash.admin.event_type.delete.success');
        } catch (\Exception $e) {
            $this->addFlash('danger', 'flash.admin.event_type.delete.danger');
        }

        return $this->redirectToRoute('admin_event_type_index');
    }
}
