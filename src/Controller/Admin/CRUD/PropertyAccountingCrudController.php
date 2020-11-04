<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\PropertyAccounting;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PropertyAccountingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PropertyAccounting::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('value', 'Valeur :'),
            DateField::new('date', 'Date :'),
            TextField::new('comment', 'Commentaire :'),
            AssociationField::new('label', 'Label :'),
            AssociationField::new('property', 'Propriété :'),
            AssociationField::new('operationType', 'Type d\'opération :')
        ];
    }

}
