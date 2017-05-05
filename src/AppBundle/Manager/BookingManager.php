<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Booking;
use AppBundle\Entity\Stock;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\User;
use AppBundle\Repository\BookingRepository;
use AppBundle\Repository\UserRepository;
use Liuggio\ExcelBundle\Factory;
use Symfony\Component\HttpFoundation\File\File;
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
        /** @var User $existingUser */
        if ($existingUser = $this->userRepository->findOneBy(
            ['email' => $user->getEmail()]
        )
        ) {
            return $this->editUser($existingUser, $user);
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
     * @param User $existingUser
     * @param User $user
     *
     * @return User
     */
    public function editUser(User $existingUser, User $user)
    {
        $existingUser->setCivility($user->getCivility());
        $existingUser->setLastName($user->getLastName());
        $existingUser->setFirstName($user->getFirstName());
        $existingUser->setBirthdayDate($user->getBirthdayDate());
        $existingUser->setAddress($user->getAddress());
        $existingUser->setZipCode($user->getZipCode());
        $existingUser->setCity($user->getCity());
        $existingUser->setIdNumber($user->getIdNumber());
        $existingUser->setPhone($user->getPhone());

        return $existingUser;
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
            ->setTitle($this->translator->trans('export.title'))
            ->setDescription($this->translator->trans('export.description'))
            ->setKeywords($this->translator->trans('export.keywords'))
            ->setCategory($this->translator->trans('export.category'));

        /** Définir la cellule correspondante au titre */
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', $this->translator->trans('export.data.beneficiary_type'))
            ->setCellValue('B1', $this->translator->trans('export.data.last_name'))
            ->setCellValue('C1', $this->translator->trans('export.data.first_name'))
            ->setCellValue('D1', $this->translator->trans('export.data.email'))
            ->setCellValue('E1', $this->translator->trans('export.data.birth_date'))
            ->setCellValue('F1', $this->translator->trans('export.data.phone'))
            ->setCellValue('G1', $this->translator->trans('export.data.address'))
            ->setCellValue('H1', $this->translator->trans('export.data.city'))
            ->setCellValue('I1', $this->translator->trans('export.data.zip_code'))
            ->setCellValue('J1', $this->translator->trans('export.data.identity_number'))
            ->setCellValue('K1', $this->translator->trans('export.data.ticket_status'))
            ->setCellValue('L1', $this->translator->trans('export.data.door'))
            ->setCellValue('M1', $this->translator->trans('export.data.floor'))
            ->setCellValue('N1', $this->translator->trans('export.data.place_number'));

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
                    ->setCellValue('A'.$i, ($booking->getMainUser() === $ticket->getUser() ? $this->translator->trans('export.data.main') : $this->translator->trans('export.data.secondary')))
                    ->setCellValue('B'.$i, $ticket->getUser()->getLastName())
                    ->setCellValue('C'.$i, $ticket->getUser()->getFirstName())
                    ->setCellValue('D'.$i, $ticket->getUser()->getEmail())
                    ->setCellValue('E'.$i, $ticket->getUser()->getBirthdayDate())
                    ->setCellValue('F'.$i, $ticket->getUser()->getPhone())
                    ->setCellValue('G'.$i, $ticket->getUser()->getAddress())
                    ->setCellValue('H'.$i, $ticket->getUser()->getCity())
                    ->setCellValue('I'.$i, $ticket->getUser()->getZipCode())
                    ->setCellValue('J'.$i, $ticket->getUser()->getIdNumber())
                    ->setCellValue('K'.$i, $ticket->isDistributed() ? $this->translator->trans('export.data.distributed') : $this->translator->trans('export.data.not_distributed'))
                    ->setCellValue('L'.$i, $ticket->getDoor())
                    ->setCellValue('M'.$i, $ticket->getFloor())
                    ->setCellValue('N'.$i, $ticket->getNumber());

                $i++;
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
        /** @var Booking[] $bookings */
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

    /**
     * @param File $csvFile
     *
     * @throws \Exception
     */
    public function importBookings(File $csvFile)
    {
        if ('txt' !== $csvFile->guessExtension()) {
            throw new \Exception($this->translator->trans('import.error.file_extension'));
        }

        $ignoreFirstLine = true;
        $i = 1;

        if (($handle = fopen($csvFile->getRealPath(), "r")) !== FALSE) {
            while(($row = fgetcsv($handle)) !== FALSE) {
                $errorMessage = $this->translator->trans('import.error.default') . ' ' . $i . ', ';

                if ($ignoreFirstLine && $i === 1) {
                    $i++;
                    continue;
                }

                $data = explode(';', current($row));

                if (count($data) !== 16) {
                    throw new \LogicException($errorMessage . $this->translator->trans('import.error.missing_data'));
                }

                $beneficiaryType    = $data[0];
                $lastName           = $data[1];
                $firstName          = $data[2];
                $email              = $data[3];
                $birthDate          = $data[4];
                $phoneNumber        = $data[5];
                $address            = $data[6];
                $city               = $data[7];
                $zipCode            = $data[8];
                $identityNumber     = $data[9];
                $ticketStatus       = $data[10];
                $door               = $data[11];
                $floor              = $data[12];
                $ticketNumber       = $data[13];
                $ticketCategorySlug = $data[14];
                $eventSlug          = $data[15];

                if (!$this->checkEmail($email)) {
                    throw new \LogicException($errorMessage . $this->translator->trans('import.error.email'));
                }

                if (!$this->checkPhoneNumber($phoneNumber)) {
                    throw new \LogicException($errorMessage . $this->translator->trans('import.error.phone_number'));
                }

                if (!$this->checkZipCode($zipCode)) {
                    throw new \LogicException($errorMessage . $this->translator->trans('import.error.zip_code'));
                }

                /** @var User $existingUser */
                $existingUser = $this->userRepository->findOneBy([
                    'email' => $email,
                ]);

                if (null !== $existingUser) {
                    $user = $existingUser;
                } else {
                    $user = new User();

                    $bytes = openssl_random_pseudo_bytes(4);
                    $pwd   = bin2hex($bytes);
                    $user
                        ->setPlainPassword($pwd)
                        ->setUsername(strtolower($lastName).strtolower($firstName))
                        ->setEmail($email)
                    ;
                }

                $user
                    ->setLastName($lastName)
                    ->setFirstName($firstName)
                    ->setBirthdayDate(\DateTime::createFromFormat('Y-m-d H:i:s', $birthDate))
                    ->setPhone($phoneNumber)
                    ->setAddress($address)
                    ->setCity($city)
                    ->setZipCode($zipCode)
                    ->setIdNumber($identityNumber)
                ;

                if ($beneficiaryType === $this->translator->trans('export.data.main')) {
                    $booking = new Booking();
                    $booking->setMainUser($user);

                    $ticketCategory = $this->em->getRepository('AppBundle:TicketCategory')->findOneBy([
                        'slug' => $ticketCategorySlug,
                    ]);

                    $event = $this->em->getRepository('AppBundle:Event')->findOneBy([
                        'slug' => $eventSlug,
                    ]);

                    if (null === $ticketCategory || null === $event) {
                        throw new \LogicException($errorMessage . $this->translator->trans('import.error.categ_event'));
                    }

                    $booking
                        ->setEvent($event)
                        ->setTicketCategory($ticketCategory)
                    ;
                }

                if (!isset($booking)) {
                    throw new \LogicException($errorMessage . $this->translator->trans('import.error.main_user'));
                }

                if ($beneficiaryType === $this->translator->trans('export.data.secondary')) {
                    $booking->addSecondaryUser($user);
                }

                $ticket = new Ticket();

                $ticket->setDistributed($ticketStatus === $this->translator->trans('export.data.distributed'));
                $ticket->setDoor($door);
                $ticket->setFloor($floor);
                $ticket->setNumber($ticketNumber);
                $ticket->setUser($user);
                $ticket->setBooking($booking);

                $booking->addTicket($ticket);

                $this->em->persist($booking);
            }

            try {
                $this->em->flush();
            } catch (\Exception $exception) {
                throw new \Exception($this->translator->trans('import.error.flush'));
            }
        }
    }

    /**
     * @param $email
     *
     * @return bool
     */
    public function checkEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    /**
     * @param $zipCode
     *
     * @return bool
     */
    public function checkZipCode($zipCode)
    {
        if (strlen($zipCode) > 6) {
            return false;
        }

        return true;
    }

    /**
     * @param $phoneNumber
     *
     * @return bool
     */
    public function checkPhoneNumber($phoneNumber)
    {
        if (0 !== strpos($phoneNumber, '+33') && 0 !== strpos($phoneNumber, '0')) {
            return false;
        }

        return true;
    }
}
