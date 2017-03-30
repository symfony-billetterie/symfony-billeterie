<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('mainUser', EntityType::class, [
                'label' => 'admin.form.booking.main_user',
                'class' => 'AppBundle:User',
                'choice_label' => 'email'
            ])
            ->add('secondaryUser', EntityType::class, [
                'label' => 'admin.form.booking.secondary_user',
                'class' => 'AppBundle:User',
                'choice_label' => 'email',
            ])
        ;
    }
}
