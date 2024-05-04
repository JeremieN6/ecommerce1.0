<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ProductCrudController extends AbstractCrudController
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }


    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureActions(Actions $actions): Actions 
    {
        return $actions
            ->add('index', 'detail')
            ;
    }

  
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name','Nom'),
            SlugField::new('slug')->setTargetFieldName('name'),
            ImageField::new('image')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('subtitle', 'Sous-titre'),
            TextareaField::new('description')->hideOnIndex(),
            MoneyField::new('price', 'Prix')->setCurrency('EUR'),
            AssociationField::new('category', 'Catégorie'),
            BooleanField::new('isInHome', 'Top produit')
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Votre logique pour persister l'entité dans la base de données
        parent::persistEntity($entityManager, $entityInstance);

        // Lier le produit à Stripe
        if ($entityInstance instanceof Product) {
            try {

                // Récupérer la clé secrète de Stripe à partir des variables d'environnement
                $stripeSecretKey = $this->params->get('STRIPE_SK_TEST');

                $productName = $entityInstance->getName();
                $productPrice = $entityInstance->getPrice();
                $productDescription = $entityInstance->getDescription();
                // $productImage = $entityInstance->getImage();

                // Récupérer le chemin vers l'image depuis l'entité Product
                $imagePath = $entityInstance->getImage();

                // Générer l'URL absolue vers l'image
                $imageUrl = $this->getParameter('app.path.upload_base_url') . '/' . $imagePath;

                $stripe = new \Stripe\StripeClient($stripeSecretKey);
                $stripe->products->create([
                    'name' => $productName,
                    'default_price_data' => // Liste des prix du produit
                        [
                            'currency' => 'eur', // Devise du prix
                            'unit_amount' => $productPrice, // Montant du prix en centimes
                        ],
                    'description' => $productDescription,
                    'images' => [$imageUrl],
                ]);

            } catch (\Stripe\Exception\ApiErrorException $e) {
                // Gérer les erreurs
                $this->addFlash('error', 'Erreur lors de la création du produit sur Stripe : ' . $e->getMessage());
            }
        }
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits')
        ;
    }

}