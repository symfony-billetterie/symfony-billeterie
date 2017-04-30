<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class BookingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('mainUser', BeneficiaryType::class, [
                'label' => 'admin.form.booking.event',
                'data_class' => User::class,
                ])*/
            ->add('event', EntityType::class, [
                'label' => 'admin.form.booking.event',
                'class' => 'AppBundle:Event',
                'choice_label' => 'name',
            ])
            ->add('ticketCategory', EntityType::class, [
                'label' => 'admin.form.booking.ticket_category',
                'class' => 'AppBundle:TicketCategory',
                'choice_label' => 'label',
            ])
            /*->add('tickets', TicketType::class, [
                'label' => 'admin.form.booking.ticket',
                'data_class' => Ticket::class,
            ])*/
            ->add('tickets', CollectionType::class, [
                'label' => 'toto',
                'entry_type' => TicketType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ]);
    }
}
