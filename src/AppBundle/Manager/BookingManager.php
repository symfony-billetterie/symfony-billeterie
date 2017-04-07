<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Booking;
use AppBundle\Entity\User;
use Liuggio\ExcelBundle\Factory;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class BookingManager
 */
class BookingManager
{
    private $phpExcel;
    private $translator;

    /**
     * BookingManager constructor.
     *
     * @param Factory             $phpExcel
     * @param TranslatorInterface $translator
     */
    public function __construct(Factory $phpExcel, TranslatorInterface $translator)
    {
        $this->phpExcel   = $phpExcel;
        $this->translator = $translator;
    }

    /**
     * @param User                      $user
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
            ->setTitle("Export réservations")
            ->setDescription("Exportation des réservations - format excel")
            ->setKeywords("export reservation billetterie")
            ->setCategory("Export");

        /** Définir la cellule correspondante au titre */
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', $this->translator->trans('Type bénéficiaire'))
            ->setCellValue('B1', 'Nom')
            ->setCellValue('C1', 'Prénom')
            ->setCellValue('D1', 'Adresse e-mail')
            ->setCellValue('E1', 'Date de naissance')
            ->setCellValue('F1', 'Téléphone')
            ->setCellValue('G1', 'Adresse')
            ->setCellValue('H1', 'Ville')
            ->setCellValue('I1', 'Code postal')
            ->setCellValue('J1', 'Pièce d’identité')
            ->setCellValue('K1', 'N° d’identité')
            ->setCellValue('L1', 'État ticket')
            ->setCellValue('M1', 'Porte')
            ->setCellValue('N1', 'Étage')
            ->setCellValue('O1', 'N° place');

        /**
         * Insérer les informations d'une réservation à chaque nouvelle ligne
         *
         * @var int     $key
         * @var Booking $booking
         */
        foreach ($bookings as $booking) {
            /** Définir la cellule correspondante à la valeur */
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, ('Principal'))
                ->setCellValue('B'.$i, $booking->getMainUser()->getLastName())
                ->setCellValue('C'.$i, $booking->getMainUser()->getFirstName())
                ->setCellValue('D'.$i, $booking->getMainUser()->getEmail())
                ->setCellValue('E'.$i, $booking->getMainUser()->getBirthdayDate())
                ->setCellValue('F'.$i, $booking->getMainUser()->getPhone())
                ->setCellValue('G'.$i, $booking->getMainUser()->getAddress())
                ->setCellValue('H'.$i, $booking->getMainUser()->getCity())
                ->setCellValue('I'.$i, $booking->getMainUser()->getZipCode())
                ->setCellValue('J'.$i, 'null')
                ->setCellValue('K'.$i, $booking->getMainUser()->getIdNumber())
                ->setCellValue('L'.$i, 'null')
                ->setCellValue('M'.$i, 'null')
                ->setCellValue('N'.$i, 'null')
                ->setCellValue('O'.$i, 'null');

            /** on incrémente le numéro de page */
            $i++;

            if (!empty($booking->getSecondaryUsers())) {
                /** @var User $user */
                foreach ($booking->getSecondaryUsers() as $user) {
                    /** Définir la cellule correspondante à la valeur */
                    $phpExcelObject->setActiveSheetIndex(0)
                        ->setCellValue('A'.$i, ('Secondaire'))
                        ->setCellValue('B'.$i, $user->getLastName())
                        ->setCellValue('C'.$i, $user->getFirstName())
                        ->setCellValue('D'.$i, $user->getEmail())
                        ->setCellValue('E'.$i, $user->getBirthdayDate())
                        ->setCellValue('F'.$i, $user->getPhone())
                        ->setCellValue('G'.$i, $user->getAddress())
                        ->setCellValue('H'.$i, $user->getCity())
                        ->setCellValue('I'.$i, $user->getZipCode())
                        ->setCellValue('J'.$i, 'null')
                        ->setCellValue('K'.$i, $user->getIdNumber())
                        ->setCellValue('L'.$i, 'null')
                        ->setCellValue('M'.$i, 'null')
                        ->setCellValue('N'.$i, 'null')
                        ->setCellValue('O'.$i, 'null');

                    /** on incrémente le numéro de page */
                    $i++;
                }
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
}
