<?php

namespace AppBundle\Form\Type;

/**
 * Class RegistrationType
 *
 * Formulaire d'inscription qui hérite de la classe UserType
 */
class RegistrationType extends UserType
{
    /**
     * @return string
     *
     * Hériter du formulaire d'inscription de FosUser
     */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
