<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'constraints' => [
                    new NotBlank(['message' => 'Merci de saisir un titre']),
                    
                ]
            ])
            ->add('body')
            ->add('nbLikes')
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('poster', UrlType::class, [
                'label' => 'Url de l\'image',
                'attr' => ['placeholder' => 'Saisir une url'],
                'default_protocol' => '',

            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'fullName',
                'label' => 'Auteur',
                'placeholder' => '-- Séléctionnez un auteur --'
                ])
            ->add('publishedAt')
            ->add('legalMentions', CheckboxType::class, [
                'label' => 'Je coche la case',
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'attr' => ['class' => 'container']
        ]);
    }
}
