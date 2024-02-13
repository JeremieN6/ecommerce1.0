<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Adresse email',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('firstname', TextType::class, [
                'disabled' => true,
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],        
            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,
                'label' => 'Nom de famille',
                'attr' => [
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],        
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre mot de passe actuel',
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => [
                    'label' => 'Nouveau mot de passe',
                    'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
                    'attr' => ['placeholder' => 'Saisir mot de passe souhaité',
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10']
                ],
                'second_options' => [
                    'label' => 'Répétez mot de passe',
                    'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
                    'attr' => ['placeholder' => 'Confirmer mot de passe ',
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10']
                ],
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un mot de passe',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Votre mot de passe doit contenir minimum 8 charactères',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer modifications',
                'attr' => [
                    'class' => 'w-full bg-gray-800 hover:bg-grey-900 text-white text-sm py-2 px-4 mt-6 font-semibold rounded focus:outline-none focus:shadow-outline h-10'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
