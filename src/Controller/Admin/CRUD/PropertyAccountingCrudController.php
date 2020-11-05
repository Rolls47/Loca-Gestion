<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\PropertyAccounting;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
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
            MoneyField::new('value', 'Valeur :')->setCurrency('EUR'),
            DateField::new('date', 'Date :'),
            TextField::new('comment', 'Commentaire :'),
            AssociationField::new('label', 'Label :'),
            AssociationField::new('property', 'Propriété :'),
            AssociationField::new('operationType', 'Type d\'opération :')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Compta Propriété')
            ->setSearchFields(['id', 'value', 'date', 'comment', 'label', 'property', 'operationType']);
    }
}
