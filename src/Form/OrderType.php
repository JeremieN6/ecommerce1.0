<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Carrier;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        $builder
            ->add('addresses', EntityType::class, [
                'label' => false,
                'required' => true,
                'class' => Address::class,
                'choice_label' => 'addressLabel', //callback récupérant une chaine concaténée
                'choices' => $user->getAddresses(),
                'expanded' => true,
                'attr' => [
                    'class' => 'bg-gray-100 font-medium py-5 rounded-lg shadow-gray-900 px-5'
                ]
            ])
            ->add('carriers', EntityType::class, [
                'label' => 'Choisissez votre transporteur',
                'required' => true,
                'class' => Carrier::class,
                'choice_label' => 'carrierLabel',
                'expanded' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Passer au paiment', 
                'attr' => [
                    'class' => "w-full bg-black hover:bg-grey-900 text-white text-sm py-2 px-4 mt-6 font-semibold rounded focus:outline-none focus:shadow-outline h-10"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user' => []        // Récupère la variable user passée dans le contoller pour la transmettre aux options du buildForm
        ]);
    }
}
