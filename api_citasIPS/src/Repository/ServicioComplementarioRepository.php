<?php

namespace App\Repository;

use App\Entity\ServicioComplementario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServicioComplementario|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServicioComplementario|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServicioComplementario[]    findAll()
 * @method ServicioComplementario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicioComplementarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServicioComplementario::class);
    }

    // /**
    //  * @return ServicioComplementario[] Returns an array of ServicioComplementario objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServicioComplementario
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
