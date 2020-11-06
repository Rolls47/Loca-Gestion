<?php

namespace App\DataFixtures;

use App\Entity\Label;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LabelFixtures extends Fixture
{
    public const LABEL = [
        [
            'name' => 'Eau'
        ],
        [
            'name' => 'Gaz'
        ],
        [
            'name' => 'Loyer'
        ],
        [
            'name' => 'Électricité'
        ],
        [
            'name' => 'Taxe foncière'
        ],
        [
            'name' => 'Travaux'
        ],
        [
            'name' => 'Crédit bancaire'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::LABEL as $data) {
            $label = new Label();
            $label->setName($data['name']);

            $manager->persist($label);
        }
        $manager->flush();
    }
}