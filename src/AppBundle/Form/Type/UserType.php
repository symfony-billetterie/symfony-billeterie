<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                'expanded' => true,
                'choices'  => User::getAvailableCivilities(),
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'label'    => 'app.form.registration.last_name',
                'required' => true,
            ])
            ->add('firstName', TextType::class, [
                'label'    => 'app.form.registration.first_name',
                'required' => true,
            ])
            ->add('birthdayDate', BirthdayType::class, [
                'label'    => 'app.form.registration.birthday',
                'widget'   => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'attr'     => ['class' => 'datepicker'],
                'required' => false,
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
                'label'    => 'app.form.registration.card',
                'required' => false,
            ])
            ->remove('username');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'error_mapping' => [
                'lower' => 'birthdayDate',
            ],
        ]);
    }
}
