<?php

namespace App\DataFixtures;

use App\Entity\LocationAccounting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LocationAccountingFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [LabelFixtures::class, OperationTypeFixtures::class, LocationFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 21; $i++) {
            $locationAccounting = new LocationAccounting();
            $comment = 'nada';
            $value = random_int(-20000, 100000);
            $location = random_int(1, 3);
            $label = random_int(1, 7);
            $operationType = random_int(1, 2);
            $locationAccounting->setComment($comment)
                ->setValue($value);
            $locationAccounting->setLocation($manager->find('App:Location', $location));
            $locationAccounting->setLabel($manager->find('App:Label', $label));
            $locationAccounting->setOperationType($manager->find('App:OperationType', $operationType));

            $manager->persist($locationAccounting);
        }
        $manager->flush();
    }
}
