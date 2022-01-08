<?php

namespace App\Repository;

use App\Entity\TipoPersonalSalud;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoPersonalSalud|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoPersonalSalud|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoPersonalSalud[]    findAll()
 * @method TipoPersonalSalud[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoPersonalSaludRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoPersonalSalud::class);
    }

    // /**
    //  * @return TipoPersonalSalud[] Returns an array of TipoPersonalSalud objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoPersonalSalud
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
