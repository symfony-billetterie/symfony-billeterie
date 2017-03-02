<?php

namespace AppBundle\Form\Type;

/**
 * Class ProfileFormType
 *
 * Formulaire d'édition d'un compte qui hérite de la classe UserType
 */
class ProfileFormType extends UserType
{
    /**
     * @return string
     *
     * Hériter du formulaire d'édition de FosUser
     */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
