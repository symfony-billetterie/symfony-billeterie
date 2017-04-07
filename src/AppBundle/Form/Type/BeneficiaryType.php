<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class BeneficiaryType
 *
 * Formulaire d'un compte utilisateur
 */
class BeneficiaryType extends UserType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'label'    => 'app.form.beneficiary.email',
                'required' => false,
            ])
        ;
    }

    public function getParent()
    {
        return UserType::class;
    }
}
