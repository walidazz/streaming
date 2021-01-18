<?php

namespace App\Controller\Admin;

use App\Entity\Saison;
use App\Form\SaisonType;
use App\Form\EpisodeType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SaisonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Saison::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            IntegerField::new('number'),
            AssociationField::new('series'),
            CollectionField::new('episodes', 'Episode')->allowAdd()
            ->allowDelete()
            ->setEntryType(EpisodeType::class)

        ];
    }
}
