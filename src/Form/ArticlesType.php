<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Themes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Article Title :',
                'required' => true,
                'attr' => [
                    'maxlength' => 255,
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Article Content :',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageFileType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'prototype' => true,
                'by_reference' => false,
                'entry_options' => ['label' => false],
                'label' => 'Images :',
                'required' => false,
            ])
            ->add('footer', TextType::class, [
                'label' => 'Insert creditentials and sources here (optionnal) :',
                'required' => false,
            ])
            ->add('proposedAt', DateType::class)
            ->add('acceptedAt', DateType::class)
            ->add('status', HiddenType::class)
            ->add('author', HiddenType::class)
            ->add('owner', HiddenType::class)
            ->add('themes', EntityType::class, [
                'label' => 'Themes :',
                'required' => true,
                'class' => Themes::class,
                'choice_label' => 'Themes',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
