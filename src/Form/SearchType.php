<?php

namespace App\Form;

use App\Entity\Category;
use App\Model\Search;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Formulaire de recherche sur la page produits
 */
class SearchType extends AbstractType
{

    /**
     * Permet de paraméter un formulaire custom
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('string', TextType::class, [
                'label' => 'Mots-clés:',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre recherche',
                    'class' => 'text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10'
                ],
                'label_attr' => ['class' => 'block text-gray-700 text-sm font-semibold mb-2'],
            ])
            ->add('categories', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Category::class, 
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'relative float-left'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'w-full bg-black hover:bg-grey-900 text-white text-sm py-2 px-4 mt-6 font-semibold rounded focus:outline-none focus:shadow-outline h-10'
                ]
            ])
        ;
    }

    public function getBlockPrefix() {
        return '';
    }
}