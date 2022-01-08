<?php

namespace App\Repository;

use App\Entity\Cita;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Cita|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cita|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cita[]    findAll()
 * @method Cita[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CitaRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    private $pacienteRepository;
    private $parentezcoRepository;
    private $estadoSeguimientoRepository;
    private $servicioAplicadoRepository;
    private $personalSaludRepository;
    private $servicioComplementarioRepository;
    private $periodoAcademicoRepository;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager,
                                PacienteRepository $pacienteRepository,
                                ParentezcoRepository $parentezcoRepository,
                                EstadoSeguimientoRepository $estadoSeguimientoRepository,
                                ServicioAplicadoRepository $servicioAplicadoRepository,
                                PersonalSaludRepository $personalSaludRepository,
                                ServicioComplementarioRepository $servicioComplementarioRepository,
                                PeriodoAcademicoRepository $periodoAcademicoRepository)
    {
        parent::__construct($registry, Cita::class);
        $this->manager = $manager;
        $this->pacienteRepository = $pacienteRepository;
        $this->parentezcoRepository = $parentezcoRepository;
        $this->estadoSeguimientoRepository = $estadoSeguimientoRepository;
        $this->servicioAplicadoRepository = $servicioAplicadoRepository;
        $this->personalSaludRepository = $personalSaludRepository;
        $this->servicioComplementarioRepository = $servicioComplementarioRepository;
        $this->periodoAcademicoRepository = $periodoAcademicoRepository;
    }

    public function guardarCita($id_paciente, $acudiente, $id_parentezco, $fecha_cita, $hora_cita, $id_estado_seguimiento, $id_servicio_aplicado, $id_personal_salud, $id_servicio_complementario, $observaciones, $id_periodo_academico)
    {
        $cita = new Cita();
        $paciente = $this->pacienteRepository->findOneBy(['id' => $id_paciente]);
        $parentezco = $this->parentezcoRepository->findOneBy(['id' => $id_parentezco]);
        $estado_seguimiento = $this->estadoSeguimientoRepository->findOneBy(['id' => $id_estado_seguimiento]);
        $servicio_aplicado = $this->servicioAplicadoRepository->findOneBy(['id' => $id_servicio_aplicado]);
        $personal_salud = $this->personalSaludRepository->findOneBy(['id' => $id_personal_salud]);
        $servicio_complementario = $this->servicioComplementarioRepository->findOneBy(['id' => $id_servicio_complementario]);
        $periodo_academico = $this->periodoAcademicoRepository->findOneBy(['id' => $id_periodo_academico]);

        $cita
            ->setPaciente($paciente)
            ->setAcudiente($acudiente)
            ->setParentezco($parentezco)
            ->setFechaCita(new \DateTime($fecha_cita))
            ->setHoraCita(new \DateTime($hora_cita))
            ->setEstadoSeguimiento($estado_seguimiento)
            ->setServicioAplicado($servicio_aplicado)
            ->setPersonalSalud($personal_salud)
            ->setServicioComplementario($servicio_complementario)
            ->setObservaciones(str_replace(null, "", $observaciones))
            ->setPeriodoAcademico($periodo_academico);

        $this->manager->persist($cita);
        $this->manager->flush();
    }

    public function actualizarCita(Cita $cita): Cita
    {
        $this->manager->persist($cita);
        $this->manager->flush();

        return $cita;
    }

    public function eliminarCita(Cita $cita)
    {
        $this->manager->remove($cita);
        $this->manager->flush();
    }

    // /**
    //  * @return Cita[] Returns an array of Cita objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cita
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
