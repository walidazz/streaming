<?php

namespace App\Controller\Admin;

use App\Entity\Serie;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SerieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Serie::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            ImageField::new('coverImage')->setBasePath('/images/series/')->setLabel('Image')->onlyOnIndex(),
            ArrayField::new('actor'),
            TextField::new('director')->setFormTypeOptions(['required' => false]),
            SlugField::new('slug')->setTargetFieldName('name'),
            TextEditorField::new('synopsis'),
            DateTimeField::new('releaseDate'),
            IntegerField::new('rating')->setFormTypeOptions(['required' => false]),
            IntegerField::new('duration')->setFormTypeOptions(['required' => false]),
            TextareaField::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            DateTimeField::new('createdAt', 'Inscrit depuis le')->onlyOnIndex(),
            DateTimeField::new('updatedAt', 'Modifié le')->onlyOnIndex(),
            AssociationField::new('saisons', 'Saison')->onlyOnIndex()


        ];
    }
}
