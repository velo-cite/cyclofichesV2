<?php

namespace App\Repository;

use App\Entity\LikerIssue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LikerIssue|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikerIssue|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikerIssue[]    findAll()
 * @method LikerIssue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikerIssueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikerIssue::class);
    }

    // /**
    //  * @return LikerIssue[] Returns an array of LikerIssue objects
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
    public function findOneBySomeField($value): ?LikerIssue
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
