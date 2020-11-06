<?php

namespace App\DataFixtures;

use App\Entity\PropertyType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PropertyTypeFixtures extends Fixture
{

    public const PROPERTYTYPE = [
        [
            'type' => 'Appartement'
        ],
        [
            'type' => 'Garage'
        ],
        [
            'type' => 'Local commercial'
        ],
        [
            'type' => 'Maison'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROPERTYTYPE as $data) {
            $propertyType = new PropertyType();
            $propertyType->setType($data['type']);

            $manager->persist($propertyType);
        }
        $manager->flush();
    }
}