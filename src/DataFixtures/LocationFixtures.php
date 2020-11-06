<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LocationFixtures extends Fixture
{
    public const LOCATION = [
        [
            'name' => 'Localisation ABC',
            'city' => 'Bordeaux',
            'address' => 'rue paul dénucé',
            'comment' => 'immeuble avec des appartements',
        ],
        [
            'name' => 'Localisation I II III',
            'city' => 'Bayona',
            'address' => 'rue du piment',
            'comment' => 'immeuble avec des appartements',
        ],
        [
            'name' => 'Localisation 1 2 3',
            'city' => 'Paris',
            'address' => 'boulevard de la libération',
            'comment' => 'immeuble avec des appartements',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::LOCATION as $data) {
            $location = new Location();
            $location->setName($data['name'])
                ->setCity($data['city'])
                ->setAddress($data['address'])
                ->setComment($data['comment']);

            $manager->persist($location);
        }
        $manager->flush();
    }
}