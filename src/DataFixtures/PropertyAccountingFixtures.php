<?php

namespace App\DataFixtures;

use App\Entity\PropertyAccounting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PropertyAccountingFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [LabelFixtures::class, OperationTypeFixtures::class, PropertyFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 31; $i++) {
            $propertyAccounting = new PropertyAccounting();
            $comment = 'nada';
            $value = random_int(0, 100000);
            $property = random_int(1, 9);
            $label = random_int(1, 7);
            $operationType = random_int(1, 2);
            $propertyAccounting->setComment($comment)
                ->setValue($value);
            $propertyAccounting->setProperty($manager->find('App:Property', $property));
            $propertyAccounting->setLabel($manager->find('App:Label', $label));
            $propertyAccounting->setOperationType($manager->find('App:OperationType', $operationType));

            $manager->persist($propertyAccounting);
        }
        $manager->flush();
    }
}
