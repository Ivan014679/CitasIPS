<?php

namespace App\Repository;

use App\Entity\PeriodoAcademico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PeriodoAcademico|null find($id, $lockMode = null, $lockVersion = null)
 * @method PeriodoAcademico|null findOneBy(array $criteria, array $orderBy = null)
 * @method PeriodoAcademico[]    findAll()
 * @method PeriodoAcademico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeriodoAcademicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PeriodoAcademico::class);
    }

    // /**
    //  * @return PeriodoAcademico[] Returns an array of PeriodoAcademico objects
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
    public function findOneBySomeField($value): ?PeriodoAcademico
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
