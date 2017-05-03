<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Booking;
use AppBundle\Entity\Stock;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\User;
use AppBundle\Repository\BookingRepository;
use AppBundle\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Liuggio\ExcelBundle\Factory;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Translation\TranslatorInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class BookingManager
 */
class BookingManager
{
    private $phpExcel;
    private $translator;
    private $userRepository;
    private $bookingRepository;
    private $em;

    /**
     * BookingManager constructor.
     *
     * @param Factory             $phpExcel
     * @param TranslatorInterface $translator
     * @param UserRepository      $userRepository
     * @param BookingRepository   $bookingRepository
     * @param EntityManager       $em
     */
    public function __construct(
        Factory $phpExcel,
        TranslatorInterface $translator,
        UserRepository $userRepository,
        BookingRepository $bookingRepository,
        EntityManager $em
    ) {
        $this->phpExcel          = $phpExcel;
        $this->translator        = $translator;
        $this->userRepository    = $userRepository;
        $this->bookingRepository = $bookingRepository;
        $this->em                = $em;
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function manageUser(User $user)
    {
        /** @var User $existantUser */
        if ($existantUser = $this->userRepository->findOneBy(
            ['email' => $user->getEmail()]
        )
        ) {
            return $this->editUser($existantUser, $user);
        } else {
            return $this->createUser($user);
        }
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function createUser(User $user)
    {
        $bytes = openssl_random_pseudo_bytes(4);
        $pwd   = bin2hex($bytes);
        $user->setPlainPassword($pwd);

        return $user;
    }

    /**
     * @param User $existantUser
     * @param User $user
     *
     * @return User
     */
    public function editUser(User $existantUser, User $user)
    {
        $existantUser->setCivility($user->getCivility());
        $existantUser->setLastName($user->getLastName());
        $existantUser->setFirstName($user->getFirstName());
        $existantUser->setBirthdayDate($user->getBirthdayDate());
        $existantUser->setAddress($user->getAddress());
        $existantUser->setZipCode($user->getZipCode());
        $existantUser->setCity($user->getCity());
        $existantUser->setIdNumber($user->getIdNumber());
        $existantUser->setPhone($user->getPhone());

        return $existantUser;
    }

    /**
     * @param Booking $booking
     *
     * @return bool
     */
    public function manageTickets(Booking $booking)
    {
        foreach ($booking->getTickets() as $ticket) {
            $ticketUser = $this->manageUser($ticket->getUser());

            $ticket->setBooking($booking);
            $ticket->setUser($ticketUser);

            if ($booking->getTickets()[key($booking->getTickets())] === $ticket) {
                $booking->setMainUser($ticketUser);
            } else {
                $booking->addSecondaryUser($ticketUser);
            }
        }

        return true;
    }

    /**
     * @param Booking $booking
     * @param array   $oldTickets
     *
     * @return bool
     */
    public function manageRemovedTickets(Booking $booking, array $oldTickets)
    {
        foreach ($oldTickets as $ticket) {
            if (!$booking->getTickets()->contains($ticket)) {
                $this->deleteTicket($ticket);
            }
        }

        return true;
    }

    /**
     * @param Ticket $ticket
     *
     * @return bool
     */
    public function deleteTicket(Ticket $ticket)
    {
        $stock      = $this->em->getRepository('AppBundle:Stock')->findOneBy(
            [
                'event'    => $ticket->getBooking()->getEvent()->getId(),
                'category' => $ticket->getBooking()->getTicketCategory()->getId(),
            ]
        );
        $countStock = $stock->getQuantity();
        $stock->setQuantity($countStock + 1);
        $this->em->flush($stock);
        $this->em->remove($ticket);

        return true;
    }

    /**
     * @param User            $user
     * @param User            $user
     * @param Booking[]|array $bookings
     *
     * @return StreamedResponse
     */
    public function exportBooking(User $user, array $bookings)
    {
        /**
         * Numéro de ligne du fichier excel - commencer à la ligne 2 par défaut
         *
         * @var int $i
         */
        $i = 2;

        /**
         * Créer l'objet PhpExcel qui
         *
         * @var \PHPExcel $phpExcelObject
         */
        $phpExcelObject = $this->phpExcel->createPHPExcelObject();
        $phpExcelObject->getProperties()->setCreator($user->getLastName().$user->getFirstName())
            ->setTitle($this->translator->trans('import_export.title'))
            ->setDescription($this->translator->trans('import_export.description'))
            ->setKeywords($this->translator->trans('import_export.keywords'))
            ->setCategory($this->translator->trans('import_export.category'));

        /** Définir la cellule correspondante au titre */
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', $this->translator->trans('import_export.data.beneficiary_type'))
            ->setCellValue('B1', $this->translator->trans('import_export.data.last_name'))
            ->setCellValue('C1', $this->translator->trans('import_export.data.first_name'))
            ->setCellValue('D1', $this->translator->trans('import_export.data.email'))
            ->setCellValue('E1', $this->translator->trans('import_export.data.birth_date'))
            ->setCellValue('F1', $this->translator->trans('import_export.data.phone'))
            ->setCellValue('G1', $this->translator->trans('import_export.data.address'))
            ->setCellValue('H1', $this->translator->trans('import_export.data.city'))
            ->setCellValue('I1', $this->translator->trans('import_export.data.zip_code'))
            ->setCellValue('J1', $this->translator->trans('import_export.data.identity_number'))
            ->setCellValue('K1', $this->translator->trans('import_export.data.ticket_status'))
            ->setCellValue('L1', $this->translator->trans('import_export.data.door'))
            ->setCellValue('M1', $this->translator->trans('import_export.data.floor'))
            ->setCellValue('N1', $this->translator->trans('import_export.data.place_number'));

        /**
         * Insérer les informations d'une réservation à chaque nouvelle ligne
         *
         * @var Booking $booking
         */
        foreach ($bookings as $booking) {
            /** @var Ticket $ticket */
            foreach ($booking->getTickets() as $ticket) {
                /** Définir la cellule correspondante à la valeur */
                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, ($booking->getMainUser() === $ticket->getUser() ? $this->translator->trans('import_export.data.main') : $this->translator->trans('import_export.data.secondary')))
                    ->setCellValue('B'.$i, $ticket->getUser()->getLastName())
                    ->setCellValue('C'.$i, $ticket->getUser()->getFirstName())
                    ->setCellValue('D'.$i, $ticket->getUser()->getEmail())
                    ->setCellValue('E'.$i, $ticket->getUser()->getBirthdayDate())
                    ->setCellValue('F'.$i, $ticket->getUser()->getPhone())
                    ->setCellValue('G'.$i, $ticket->getUser()->getAddress())
                    ->setCellValue('H'.$i, $ticket->getUser()->getCity())
                    ->setCellValue('I'.$i, $ticket->getUser()->getZipCode())
                    ->setCellValue('J'.$i, $ticket->getUser()->getIdNumber())
                    ->setCellValue('K'.$i, $ticket->isDistributed() ? $this->translator->trans('import_export.data.distributed') : $this->translator->trans('import_export.data.not_distributed'))
                    ->setCellValue('L'.$i, $ticket->getDoor())
                    ->setCellValue('M'.$i, $ticket->getFloor())
                    ->setCellValue('N'.$i, $ticket->getNumber());
            }
        }
        $phpExcelObject->getActiveSheet()->setTitle('Reservations');
        $writer            = $this->phpExcel->createWriter($phpExcelObject, 'Excel5');
        $response          = $this->phpExcel->createStreamedResponse($writer);
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'export-reservations.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    /**
     * @param Stock $stock
     *
     * @return int
     */
    public function countReservedTickets(Stock $stock)
    {
        /** @var Booking[]|ArrayCollection $bookings */
        $bookings = $this->bookingRepository->findBy(
            [
                'event'          => $stock->getEvent()->getId(),
                'ticketCategory' => $stock->getCategory()->getId(),
            ]
        );

        $ticketCount = 0;
        /** @var Booking $booking */
        foreach ($bookings as $booking) {
            $ticketCount += count($booking->getTickets());
        }

        return $ticketCount;
    }
}
