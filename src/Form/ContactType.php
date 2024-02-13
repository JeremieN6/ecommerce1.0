<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'=> 'Prénom',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('lastname', TextType::class, [
                'label'=> 'Nom',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('email', EmailType::class, [
                'label'=> 'Email',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('content', TextareaType::class, [
                'label'=> 'Message',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-50'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'w-full bg-gray-800 hover:bg-grey-900 text-white text-sm py-2 px-4 mt-6 font-semibold rounded focus:outline-none focus:shadow-outline h-10'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
