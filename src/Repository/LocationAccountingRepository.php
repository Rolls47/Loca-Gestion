<?php

namespace App\Repository;

use App\Entity\LocationAccounting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LocationAccounting|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocationAccounting|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocationAccounting[]    findAll()
 * @method LocationAccounting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationAccountingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocationAccounting::class);
    }

    // /**
    //  * @return LocationAccounting[] Returns an array of LocationAccounting objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LocationAccounting
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
