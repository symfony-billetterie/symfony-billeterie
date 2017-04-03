<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Booking;
use AppBundle\Form\Type\BookingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

class BookingController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/", name="front_booking_index")
     */
    public function indexAction(Request $request): Response
    {
        /** @var  $bookings */
        $bookings = $this->getDoctrine()->getRepository('AppBundle:Booking')->findAll();

        return $this->render('front/booking/index.html.twig', [
            'booking' => $bookings,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/add", name="front_booking_add")
     */
    public function addAction(Request $request): Response
    {
        $booking = new Booking();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(Booking::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->persist($booking);
                $em->flush();
                $this->addFlash('success', 'flash.front.booking.add.success');

                return $this->redirectToRoute('front_booking_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'flash.front.booking.add.danger');
            }
        }

        return $this->render('front/booking/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return Response
     *
     * @Route("/edit/{slug}", name="front_booking_edit")
     */
    public function editAction(Request $request, string $slug): Response
    {
        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('AppBundle:Booking')->findOneBySlug($slug);

        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->persist($booking);
                $em->flush();
                $this->addFlash('success', 'flash.front.booking.edit.success');

                return $this->redirectToRoute('front_booking_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'flash.front.booking.edit.danger');
            }
        }

        return $this->render('front/booking/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return Response
     *
     * @Route("/delete/{slug}", name="front_booking_delete")
     */
    public function deleteAction(Request $request, string $slug): Response
    {
        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('AppBundle:Booking')->findOneBySlug($slug);
        $em->remove($booking);
        try {
            $em->flush();
            $this->addFlash('success', 'flash.front.booking.delete.success');
        } catch (\Exception $e) {
            $this->addFlash('danger', 'flash.front.booking.delete.danger');
        }

        return $this->redirectToRoute('front_booking_index');
    }
}
