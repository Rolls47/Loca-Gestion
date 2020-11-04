<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Label;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LabelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Label::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom :'),
        ];
    }

}
