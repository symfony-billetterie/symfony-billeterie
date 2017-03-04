<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\EventType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Controller\Traits\UtilitiesTrait;

/**
 * Class EventTypeType
 */
class EventTypeType extends AbstractType
{
    use UtilitiesTrait;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'admin.form.event_type.name',
            ]);
    }
}
