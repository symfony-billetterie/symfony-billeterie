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
 * Class BookingController
 *
 * @Route("/reservation")
 */
class BookingController extends Controller
{
    use UtilitiesTrait;

    /**
     * Liste des réservations par événement
     *
     * @Route("/", name="admin_booking_index")
     * @Method({"GET"})
     *
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();

        $bookings = $this->getDoctrine()->getRepository('AppBundle:Booking')->findAll();

        /** @var Event[] $events */
        $events = $em->getRepository('AppBundle:Event')->findAll();

        return $this->render(
            'admin/booking/index.html.twig',
            [
                'bookings' => $bookings,
                'events'   => $events,
            ]
        );
    }

    /**
     * Call ajax pour tri liste réservations par événement
     *
     * @Route("/ajax-liste-reservation", name="admin_ajax_booking_list_index")
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function ajaxTriReservationsAction(Request $request)
    {
        $event    = $request->request->get('event');
        $bookings = $this->getDoctrine()->getRepository('AppBundle:Booking')->findBy(
            ['event' => $event]
        );

        return $this->render(
            'admin/booking/_booking_list.html.twig',
            [
                'bookings' => $bookings,
            ]
        );
    }
}
