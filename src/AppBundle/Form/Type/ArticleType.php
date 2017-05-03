<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Class ArticleType
 */
class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'admin.form.article.title',
            ])
            ->add('content', TextareaType::class, [
                'label' => 'admin.form.article.content',
                'required' => false,
            ])
            ->add('image', VichImageType::class, [
                'label'    => 'admin.form.article.image',
                'required' => false,
            ])
            ->add('file', VichFileType::class, [
                'label'    => 'admin.form.article.file',
                'required' => false,
            ]);
    }
}
