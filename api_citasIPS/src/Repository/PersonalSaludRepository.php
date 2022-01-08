<?php

namespace App\Repository;

use App\Entity\PersonalSalud;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method PersonalSalud|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonalSalud|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonalSalud[]    findAll()
 * @method PersonalSalud[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonalSaludRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    private $tipoPersonalSaludRepository;
    private $personaRepository;
    private $periodoAcademicoRepository;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager,
                                TipoPersonalSaludRepository $tipoPersonalSaludRepository,
                                PersonaRepository $personaRepository,
                                PeriodoAcademicoRepository $periodoAcademicoRepository)
    {
        parent::__construct($registry, PersonalSalud::class);
        $this->manager = $manager;
        $this->tipoPersonalSaludRepository = $tipoPersonalSaludRepository;
        $this->personaRepository = $personaRepository;
        $this->periodoAcademicoRepository = $periodoAcademicoRepository;
    }

    public function agregarPersonalSalud($id_persona, $id_tipo_personal_salud, $id_periodo_academico): string
    {
        $periodoAcademico = $this->periodoAcademicoRepository->findOneBy(['id' => $id_periodo_academico]);

        $personalSalud = $this->findOneBy(['persona' => $id_persona]);
        if($personalSalud != null){
            if($personalSalud->getPeriodosAcademicos()->contains($periodoAcademico)){
                return 'ERROR';
            }else{
                $personalSalud->addPeriodosAcademicos($periodoAcademico);
            }
        }else{
            $personalSalud = new PersonalSalud();
            $tipoPersonalSalud = $this->tipoPersonalSaludRepository->findOneBy(['id' => $id_tipo_personal_salud]);
            $persona = $this->personaRepository->findOneBy(['id' => $id_persona]);

            $personalSalud
                ->setPersona($persona)
                ->setTipoPersonalSalud($tipoPersonalSalud)
                ->addPeriodosAcademicos($periodoAcademico);
        }

        $this->manager->persist($personalSalud);
        $this->manager->flush();

        return 'OK';
    }

    // /**
    //  * @return PersonalSalud[] Returns an array of PersonalSalud objects
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
    public function findOneBySomeField($value): ?PersonalSalud
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
