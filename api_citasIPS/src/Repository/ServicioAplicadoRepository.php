<?php

namespace App\Repository;

use App\Entity\ServicioAplicado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServicioAplicado|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServicioAplicado|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServicioAplicado[]    findAll()
 * @method ServicioAplicado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicioAplicadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServicioAplicado::class);
    }

    // /**
    //  * @return ServicioAplicado[] Returns an array of ServicioAplicado objects
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
    public function findOneBySomeField($value): ?ServicioAplicado
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
