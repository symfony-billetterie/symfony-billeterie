<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Stock;
use AppBundle\Form\Type\EventType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Event;
use AppBundle\Controller\Traits\UtilitiesTrait;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EventController
 *
 * @Route("/evenement")
 */
class EventController extends Controller
{
    use UtilitiesTrait;

    /**
     * Liste des événements
     *
     * @Route("/", name="admin_event_index")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function indexAction()
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findAll();

        return $this->render('admin/event/index.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * Ajout d'un événement
     *
     * @Route("/ajouter", name="admin_event_add")
     * @param Request $request
     *
     * @return Response
     */
    public function addAction(Request $request)
    {
        /** @var BookingManager $bookingManager */
        $eventManager = $this->get('app.manager.event');

        /* Initialization stock for event */
        $event = $eventManager->createEvent();

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($event);
                $em->flush();
                $this->addFlash('success', 'flash.admin.event.add.success');

                return $this->redirectToRoute('admin_event_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'flash.admin.event.add.danger');
            }
        }

        return $this->render('admin/event/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Modification d'un événement
     *
     * @param Request $request
     * @param string $slug
     *
     * @return Response
     *
     * @Route("/editer/{slug}", name="admin_event_edit")
     */
    public function editAction(Request $request, string $slug)
    {
        $em = $this->getDoctrine();

        /** @var Event $event */
        $event = $em->getRepository('AppBundle:Event')->findOneBy(['slug' => $slug]);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->getManager()->persist($event);
                $em->getManager()->flush();
                $this->addFlash('success', 'flash.admin.event.edit.success');

                return $this->redirectToRoute('admin_event_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'flash.admin.event.edit.danger');
            }
        }

        return $this->render('admin/event/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Suppression d'un événement
     *
     * @Route("/supprimer/{slug}", name="admin_event_delete")
     * @param string $slug
     *
     * @return RedirectResponse
     */
    public function deleteAction(string $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')->findOneBy(['slug' => $slug]);
        $em->remove($event);
        try {
            $em->flush();
            $this->addFlash('success', 'flash.admin.event.delete.success');
        } catch (\Exception $e) {
            $this->addFlash('danger', 'flash.admin.event.delete.danger');
        }

        return $this->redirectToRoute('admin_event_index');
    }
}
