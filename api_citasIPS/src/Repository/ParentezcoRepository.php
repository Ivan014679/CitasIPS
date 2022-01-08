<?php

namespace App\Repository;

use App\Entity\Parentezco;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Parentezco|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parentezco|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parentezco[]    findAll()
 * @method Parentezco[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParentezcoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parentezco::class);
    }

    // /**
    //  * @return Parentezco[] Returns an array of Parentezco objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Parentezco
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
