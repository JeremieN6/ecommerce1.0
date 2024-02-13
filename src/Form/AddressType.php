<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'adresse',
                'attr' => [
                    'placeholder' => 'ex: Pavillon - Résidence - Appartemment N°...',
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('lastname', TextType::class, [
                'label' =>'Nom de famille',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('company', TextType::class, [
                'label' => 'Société (facultatif)',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
                'required' => false,
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse postale',
                'attr' => [
                    'placeholder' => 'ex: 8 rue de Lasoif',
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('postal', TextType::class, [
                'label' => 'Code postal',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],

            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer adresse',
                'attr' => [
                    'class' => 'w-full bg-gray-800 hover:bg-grey-900 mt-6 text-white text-sm py-2 px-4 font-semibold rounded focus:outline-none focus:shadow-outline h-10'
                ]
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
