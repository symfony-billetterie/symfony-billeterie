<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Article;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
        /** @var Article $article */
        $article = $options['article'];
        $finder = new Finder();
        $file =$finder->name($article->getImageName())->files();
        dump($file);die();
        $builder
            ->add('title', TextType::class, [
                'label' => 'admin.form.article.title',
            ])
            ->add('content', TextareaType::class, [
                'label' => 'admin.form.article.content',
            ])
            ->add('image', VichImageType::class, [
                'label'    => 'admin.form.article.image',
                'required' => false,
                'data'     => $article->getImageName(),
                'mapped'   => true,
            ])
            ->add('file', VichFileType::class, [
                'label'    => 'admin.form.article.file',
                'required' => false,
                'data'     => $article->getFileName(),
                'mapped'   => true,
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'article' => null,
        ]);
    }
}
