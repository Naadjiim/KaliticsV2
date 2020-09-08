<?php

namespace App\Repository;

use App\Entity\FunctionUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FunctionUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method FunctionUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method FunctionUser[]    findAll()
 * @method FunctionUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FunctionUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FunctionUser::class);
    }

    // /**
    //  * @return FunctionUser[] Returns an array of FunctionUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FunctionUser
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
