<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\OperationType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OperationTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OperationType::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('type', 'Type :'),
        ];
    }

}
