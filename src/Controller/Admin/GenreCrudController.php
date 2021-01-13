<?php

namespace App\Controller\Admin;

use App\Entity\Genre;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GenreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Genre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id')->onlyOnIndex(),
            // TextField::new('name'),
            // ImageField::new('illustration')->setBasePath('/uploads/article_image/')->setLabel('Image du produit')->onlyOnIndex(),

            // TextField::new('subtitle'),
            // SlugField::new('slug')->setTargetFieldName('name'),
            // TextEditorField::new('description'),
            // MoneyField::new('price')->setCurrency('EUR'),
            // AssociationField::new('category'),
            // CollectionField::new('pictures')
            //     ->setEntryType(AttachmentType::class)->setFormTypeOption('by_reference', false)->onlyOnForms(),
            // ImageField::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            // // CollectionField::new('pictures')
            // //     ->setTemplatePath('/images/image.html.twig')
            // //     ->onlyOnDetail(),
            // //TODO: les attachments ne s'affichent pas en detail si CollectionField est activé onForm()
            // BooleanField::new('isBest', 'Produit vedette'),
        ];
    }
}
