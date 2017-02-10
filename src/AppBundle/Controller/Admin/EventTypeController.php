<?php

namespace AppBundle\Controller;

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
        /*dump($eventTypes);die;*/

        return $this->render('app/event_type/index.html.twig', [
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
        if (is_null($eventType)) {
            $eventType = new EventType();
        }

        $form = $this->createFormBuilder($eventType)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Créer'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $eventType = $form->getData();

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($eventType);
            $em->flush();

            return $this->redirectToRoute('index_event_type');
        }

        return $this->render(':app/event_type:edit.html.twig', array(
            'form' => $form->createView(),
        ));
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
        $em->flush();

        return $this->redirectToRoute('index_event_type');
    }
}
