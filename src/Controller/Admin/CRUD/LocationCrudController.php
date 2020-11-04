<?php

namespace App\Controller\Admin\CRUD;

use App\Entity\Location;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom :'),
            TextField::new('city', 'Ville :'),
            TextField::new('address', 'Adresse :'),
            TextField::new('comment', 'Commentaire :'),
            TextField::new('name', 'Nom :'),
        ];
    }

}
