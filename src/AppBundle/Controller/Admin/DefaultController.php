<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Event;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Controller\Traits\UtilitiesTrait;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    use UtilitiesTrait;

    /**
     * @Route("/", name="admin_homepage")
     * @Method({"GET"})
     *
     * @return Response
     *
     * Retourne la page d'accueil du Back Office
     */
    public function indexAction()
    {
        /** @var Event[]|ArrayCollection $event */
        $events  = $this->getDoctrine()->getRepository('AppBundle:Event')->findLastEvents();
        $objects = [];
        /** @var Event $event */
        foreach ($events as $event) {
            $bookingRepository   = $this->getDoctrine()->getRepository('AppBundle:Booking');
            $bookingsDistributed = $bookingRepository->findBookingNumber(true, $event);
            $bookings            = $bookingRepository->findBookingNumber(false, $event);
            $remainingPlaces     = $this->getDoctrine()->getRepository('AppBundle:Event')->findRemainingPlaces($event);
            $objects[]           = [
                'event'               => $event,
                'bookings'            => $bookings,
                'bookingsDistributed' => $bookingsDistributed,
                'remainingPlaces'     => $remainingPlaces,
            ];
        }

        return $this->render('admin/default/index.html.twig', [
            'objects' => $objects,
        ]);
    }
}
