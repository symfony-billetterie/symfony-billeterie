<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\EventType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class EventTypeController
 * @Route("/type-evenement")
 *
 * @package AppBundle\Controller
 */
class EventTypeController extends Controller
{
    /**
     * @Route("/index", name="index_event_type")
     * @Method({"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $eventTypes = $this->getDoctrine()->getRepository('AppBundle:EventType')->findAll();

        return $this->render('admin/event_type/index.html.twig', [
            'eventTypes' => $eventTypes,
        ]);
    }

    /**
     * @Route("/add", name="add_event_type")
     * @Route("/edit/{eventType}", name="edit_event_type")
     * @param Request $request
     * @param EventType|null $eventType
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, EventType $eventType = null)
    {
        $edit = true;
        if (is_null($eventType)) {
            $edit = false;
            $eventType = new EventType();
        }

        $form = $this->createFormBuilder($eventType)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Créer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventType = $form->getData();
            // Save
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($eventType);
                $em->flush();

                if ($edit) {
                    $this->addFlash('success', 'flash.admin.event_type.edit.success');
                } else {
                    $this->addFlash('success', 'flash.admin.event_type.add.success');
                }
            } catch (\Exception $e) {
                if ($edit) {
                    $this->addFlash('danger', 'flash.admin.event_type.edit.danger');
                } else {
                    $this->addFlash('danger', 'flash.admin.event_type.add.danger');
                }
            }

            // Flash message
            if ($edit) {
                $this->addFlash('success', 'flash.admin.event_type.edit.success');
            } else {
                $this->addFlash('success', 'flash.admin.event_type.add.success');
            }


            return $this->redirectToRoute('index_event_type');
        }

        return $this->render('admin/event_type/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{eventType}", name="delete_event_type")
     * @param EventType $eventType
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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

        return $this->redirectToRoute('index_event_type');
    }
}
