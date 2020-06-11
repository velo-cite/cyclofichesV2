<?php

namespace App\Repository;

use App\Entity\RightCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RightCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method RightCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method RightCategory[]    findAll()
 * @method RightCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RightCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RightCategory::class);
    }

    // /**
    //  * @return RightCategory[] Returns an array of RightCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RightCategory
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
