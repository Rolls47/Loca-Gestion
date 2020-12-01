<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Property;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom :'),
            TextField::new('comment', 'Commentaire :'),
            AssociationField::new('location', 'Localisation :'),
            AssociationField::new('propertyType', 'Type de propriété :')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Propriété')
            ->setSearchFields(['id', 'name', 'comment', 'location.name', 'propertyType.type']);
    }
}
