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

    public function totalLocationAccounting()
    {
        return $this->createQueryBuilder('l')
            ->select('SUM(l.value)')
            ->getQuery()->getOneOrNullResult();
    }
}
