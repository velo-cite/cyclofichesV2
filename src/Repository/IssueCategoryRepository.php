<?php

namespace App\Repository;

use App\Entity\IssueCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IssueCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method IssueCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method IssueCategory[]    findAll()
 * @method IssueCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IssueCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IssueCategory::class);
    }

    // /**
    //  * @return IssueCategory[] Returns an array of IssueCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IssueCategory
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
