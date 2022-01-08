<?php

namespace App\Repository;

use App\Entity\PracticasEstudiante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PracticasEstudiante|null find($id, $lockMode = null, $lockVersion = null)
 * @method PracticasEstudiante|null findOneBy(array $criteria, array $orderBy = null)
 * @method PracticasEstudiante[]    findAll()
 * @method PracticasEstudiante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PracticasEstudianteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PracticasEstudiante::class);
    }

    /**
    * @return PracticasEstudiante[]
    */
    public function findByPeriodoAcademico($anio, $periodo): array
    {
        switch ($periodo){
            case 1:
                $mesYDiaInicio = "01-01";
                $mesYDiaFin = "06-30";
                break;
            case 2:
                $mesYDiaInicio = "07-01";
                $mesYDiaFin = "12-31";
                break;
        }

        $fechaInicio = $anio.'-'.$mesYDiaInicio;
        $fechaFin = $anio.'-'.$mesYDiaFin;

        return $this->createQueryBuilder('p')
            ->where('p.fecha_inicio >= :val')
            ->setParameter('val', $fechaInicio)
            ->andWhere('p.fecha_fin <= :val2')
            ->setParameter('val2', $fechaFin)
            ->andWhere('p.activa = true')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return PracticasEstudiante[] Returns an array of PracticasEstudiante objects
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
    public function findOneBySomeField($value): ?PracticasEstudiante
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
