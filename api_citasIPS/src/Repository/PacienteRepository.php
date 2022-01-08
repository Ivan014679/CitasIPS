<?php

namespace App\Repository;

use App\Entity\Paciente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Paciente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paciente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paciente[]    findAll()
 * @method Paciente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PacienteRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    private $estudianteRepository;
    private $modalidadAfiliacionRepository;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager,
                                EstudianteRepository $estudianteRepository, ModalidadAfiliacionRepository $modalidadAfiliacionRepository)
    {
        parent::__construct($registry, Paciente::class);
        $this->manager = $manager;
        $this->estudianteRepository = $estudianteRepository;
        $this->modalidadAfiliacionRepository = $modalidadAfiliacionRepository;
    }

    public function guardarPaciente($id_estudiante, $id_modalidad_afiliacion, $eps)
    {
        $paciente = new Paciente();
        $estudiante = $this->estudianteRepository->findOneBy(['id' => $id_estudiante]);
        $modalidadAfiliacion = $this->modalidadAfiliacionRepository->findOneBy(['id' => $id_modalidad_afiliacion]);

        $paciente
            ->setEstudiante($estudiante)
            ->setModalidadAfiliacion($modalidadAfiliacion)
            ->setEps($eps);

        $this->manager->persist($paciente);
        $this->manager->flush();
    }

    // /**
    //  * @return Paciente[] Returns an array of Paciente objects
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
    public function findOneBySomeField($value): ?Paciente
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
