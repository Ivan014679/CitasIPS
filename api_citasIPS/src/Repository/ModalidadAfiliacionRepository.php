<?php

namespace App\Repository;

use App\Entity\ModalidadAfiliacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModalidadAfiliacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModalidadAfiliacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModalidadAfiliacion[]    findAll()
 * @method ModalidadAfiliacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModalidadAfiliacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModalidadAfiliacion::class);
    }

    // /**
    //  * @return ModalidadAfiliacion[] Returns an array of ModalidadAfiliacion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModalidadAfiliacion
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
