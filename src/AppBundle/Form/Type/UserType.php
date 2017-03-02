<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserType
 *
 * Formulaire d'un compte utilisateur
 */
class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civility', ChoiceType::class, [
                'label'    => 'app.form.registration.gender',
                'multiple' => false,
                'expanded' => false,
                'choices'  => User::getAvailableCivilities(),
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'label'    => 'app.form.registration.last_name',
                'required' => true,
            ])
            ->add('firstName', TextType::class, [
                'label'    => 'app.form.registration.first_name',
                'required' => true,
            ])
            ->add('address', TextType::class, [
                'label'    => 'app.form.registration.address',
                'required' => false,
            ])
            ->add('zipCode', TextType::class, [
                'label'    => 'app.form.registration.zip_code',
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label'    => 'app.form.registration.city',
                'required' => false,
            ])
            ->add('phone', TextType::class, [
                'label'    => 'app.form.registration.phone',
                'required' => false,
            ])
            ->add('idNumber', TextType::class, [
                'label'    => 'app.form.r

use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;egistration.card',
                'required' => false,
            ]);
    }
}
