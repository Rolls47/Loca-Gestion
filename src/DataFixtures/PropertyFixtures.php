<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PropertyFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROPERTY = [
        [
            'name' => 'Appartement A',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement B',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement C',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement I',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement II',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement III',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement 1',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement 2',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement 3',
            'comment' => 'nada',
        ],

    ];

    public function getDependencies(): array
    {
        return [LocationFixtures::class, PropertyTypeFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::PROPERTY as $data) {
            $property = new Property();
            $location = random_int(1, 3);
            $propertyType = random_int(1, 4);
            $property->setName($data['name'])
                ->setComment($data['comment']);
            $property->setLocation($manager->find('App:Location', $location));
            $property->setPropertyType($manager->find('App:PropertyType', $propertyType));

            $manager->persist($property);
        }
        $manager->flush();
    }
}