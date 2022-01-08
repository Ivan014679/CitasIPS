<?php

namespace App\Controller;

use App\Entity\Cita;
use App\Entity\Paciente;
use App\Repository\PeriodoAcademicoRepository;
use App\Repository\TipoIdentificacionRepository;
use App\Repository\ProgramaRepository;
use App\Repository\ModalidadAfiliacionRepository;
use App\Repository\ParentezcoRepository;
use App\Repository\EstadoSeguimientoRepository;
use App\Repository\ServicioAplicadoRepository;
use App\Repository\PersonalSaludRepository;
use App\Repository\TipoPersonalSaludRepository;
use App\Repository\ServicioComplementarioRepository;
use App\Repository\CitaRepository;
use Doctrine\Common\Collections\Collection;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class ReportesController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class ReportesController extends AbstractController
{
    private $tipoIdentificacionRepository;
    private $programaRepository;
    private $modalidadAfiliacionRepository;
    private $periodoAcademicoRepository;
    private $parentezcoRepository;
    private $estadoSeguimientoRepository;
    private $servicioAplicadoRepository;
    private $personalSaludRepository;
    private $tipoPersonalSaludRepository;
    private $servicioComplementarioRepository;
    private $citaRepository;

    public function __construct(PeriodoAcademicoRepository $periodoAcademicoRepository,
                                TipoIdentificacionRepository $tipoIdentificacionRepository,
                                ProgramaRepository $programaRepository,
                                ModalidadAfiliacionRepository $modalidadAfiliacionRepository,
                                ParentezcoRepository $parentezcoRepository,
                                EstadoSeguimientoRepository $estadoSeguimientoRepository,
                                ServicioAplicadoRepository $servicioAplicadoRepository,
                                PersonalSaludRepository $personalSaludRepository,
                                TipoPersonalSaludRepository $tipoPersonalSaludRepository,
                                ServicioComplementarioRepository $servicioComplementarioRepository,
                                CitaRepository $citaRepository)
    {
        $this->periodoAcademicoRepository = $periodoAcademicoRepository;
        $this->tipoIdentificacionRepository = $tipoIdentificacionRepository;
        $this->programaRepository = $programaRepository;
        $this->modalidadAfiliacionRepository = $modalidadAfiliacionRepository;
        $this->parentezcoRepository = $parentezcoRepository;
        $this->estadoSeguimientoRepository = $estadoSeguimientoRepository;
        $this->servicioAplicadoRepository = $servicioAplicadoRepository;
        $this->personalSaludRepository = $personalSaludRepository;
        $this->tipoPersonalSaludRepository = $tipoPersonalSaludRepository;
        $this->servicioComplementarioRepository = $servicioComplementarioRepository;
        $this->citaRepository = $citaRepository;
    }

    /**
     * @Route("reportes/exportar/{periodoAcademico},{tipo}", name="exportar_excel", methods={"GET"})
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function excel($periodoAcademico, $tipo)
    {
        $spreadsheet = new Spreadsheet();

        /* @var $sheet Worksheet */
        $sheet = $spreadsheet->setActiveSheetIndex(0);
        switch ($tipo) {
            case 1: //Número de consultas por género
                $sheet->setCellValue('A1', 'Género');
                $sheet->setCellValue('B1', 'Número de consultas');
                $sheet->getColumnDimension('A')->setWidth(10);
                $sheet->getColumnDimension('B')->setWidth(20);
                $totalCitas = $this->conteoCitasGenero($periodoAcademico);

                $row = 2;
                foreach ($totalCitas as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['genero']);
                    $sheet->setCellValue('B'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° consultas por género");
                break;
            case 2: //Número de consultas por edad
                $sheet->setCellValue('A1', 'Edad');
                $sheet->setCellValue('B1', 'Número de consultas');
                $sheet->getColumnDimension('A')->setWidth(10);
                $sheet->getColumnDimension('B')->setWidth(20);
                $totalCitas = $this->conteoCitasEdad($periodoAcademico);

                $row = 2;
                foreach ($totalCitas as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['edad']);
                    $sheet->setCellValue('B'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° consultas por edad");
                break;
            case 3: //Número de consultas por estrato
                $sheet->setCellValue('A1', 'Estrato');
                $sheet->setCellValue('B1', 'Número de consultas');
                $sheet->getColumnDimension('A')->setWidth(10);
                $sheet->getColumnDimension('B')->setWidth(20);
                $totalCitas = $this->conteoCitasEstrato($periodoAcademico);

                $row = 2;
                foreach ($totalCitas as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['estrato']);
                    $sheet->setCellValue('B'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° consultas por estrato");
                break;
            case 4: //Número de consultas por programa
                $sheet->setCellValue('A1', 'Programa');
                $sheet->setCellValue('B1', 'Número de consultas');
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(20);
                $totalCitas = $this->conteoCitasPrograma($periodoAcademico);

                $row = 2;
                foreach ($totalCitas as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['programa']);
                    $sheet->setCellValue('B'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° consultas por programa");
                break;
            case 5: //Número de consultas por servicio aplicado
                $sheet->setCellValue('A1', 'Servicio aplicado');
                $sheet->setCellValue('B1', 'Número de consultas');
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(20);
                $totalCitas = $this->conteoCitasServicioAplicado($periodoAcademico);

                $row = 2;
                foreach ($totalCitas as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['servicio_aplicado']);
                    $sheet->setCellValue('B'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° consultas por serv. apl.");
                break;
            case 6: //Número de consultas por servicio complementario
                $sheet->setCellValue('A1', 'Servicio complementario');
                $sheet->setCellValue('B1', 'Número de consultas');
                $sheet->getColumnDimension('A')->setWidth(23);
                $sheet->getColumnDimension('B')->setWidth(20);
                $totalCitas = $this->conteoCitasServicioComplementario($periodoAcademico);

                $row = 2;
                foreach ($totalCitas as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['servicio_complementario']);
                    $sheet->setCellValue('B'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° consultas por serv. compl.");
                break;
            case 7: //Número de consultas por tipo profesional
                $sheet->setCellValue('A1', 'Profesional');
                $sheet->setCellValue('B1', 'Número de consultas');
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(20);
                $totalCitas = $this->conteoCitasTipoPersonalSalud($periodoAcademico);

                $row = 2;
                foreach ($totalCitas as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['tipo_personal_salud']);
                    $sheet->setCellValue('B'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° consultas por profesional");
                break;
            case 8: //Número de citas por deserción
                $sheet->setCellValue('A1', 'Profesional');
                $sheet->setCellValue('B1', 'Número de deserciones');
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(23);
                $totalCitas = $this->conteoCitasDesercion($periodoAcademico);

                $row = 2;
                foreach ($totalCitas as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['tipo_personal_salud']);
                    $sheet->setCellValue('B'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° deserciones");
                break;
            case 9: //Número de pacientes por EPS
                $sheet->setCellValue('A1', 'EPS');
                $sheet->setCellValue('B1', 'Número de pacientes');
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(20);
                $totalPacientes = $this->conteoPacientesEPS();

                $row = 2;
                foreach ($totalPacientes as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['eps']);
                    $sheet->setCellValue('B'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° pacientes por EPS");
                break;
            case 10: //Total semestre
                $sheet->setCellValue('A1', 'Programa');
                $sheet->setCellValue('B1', 'Semestre');
                $sheet->setCellValue('C1', 'Número de consultas');
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(20);
                $totalCitas = $this->conteoCitasTotalSemestre($periodoAcademico);

                $row = 2;
                foreach ($totalCitas as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['programa']);
                    $sheet->setCellValue('B'.$row, $registro['semestre']);
                    $sheet->setCellValue('C'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° consultas por total semestre");
                break;
            case 11: //Proceso seguimiento
                $sheet->setCellValue('A1', 'Profesional');
                $sheet->setCellValue('B1', 'Nombres');
                $sheet->setCellValue('C1', 'Número de consultas');
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(20);
                $totalCitas = $this->conteoCitasSeguimiento($periodoAcademico);

                $row = 2;
                foreach ($totalCitas as $registro) {
                    $sheet->setCellValue('A'.$row, $registro['tipo_personal_salud']);
                    $sheet->setCellValue('B'.$row, $registro['personal_salud']);
                    $sheet->setCellValue('C'.$row, $registro['total']);

                    $row++;
                }

                $sheet->setTitle("N° consultas por seguimiento");
                break;
        }

        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);

        // Create a Temporary file in the system
        $fileName = date("d-m-Y").'_'.$periodoAcademico.'_'.$tipo.'.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);

        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }

    public function conteoCitasGenero($periodoAcademico): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Cita::class);

        $totalCitasMasculino = $repoCitas->createQueryBuilder('c')
            ->join('c.paciente', 'p')
            ->join('p.estudiante', 'e')
            ->join('e.persona', 'pe')
            ->where("pe.genero = '01' AND c.periodo_academico = ".$periodoAcademico)
            ->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $totalCitasFemenino = $repoCitas->createQueryBuilder('c')
            ->join('c.paciente', 'p')
            ->join('p.estudiante', 'e')
            ->join('e.persona', 'pe')
            ->where("pe.genero = '02' AND c.periodo_academico = ".$periodoAcademico)
            ->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $totalCitas = [
            0 => [
                'genero' => "Masculino",
                'total' => $totalCitasMasculino,
            ],
            1 => [
                'genero' => "Femenino",
                'total' => $totalCitasFemenino,
            ],
        ];

        return $totalCitas;
    }

    /**
     * @Route("reportes/genero/{periodoAcademico}", name="reportes_genero", methods={"GET"})
     */
    public function consultasPorGenero($periodoAcademico): JsonResponse
    {
        $data = $this->conteoCitasGenero($periodoAcademico);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function conteoCitasEdad($periodoAcademico): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Cita::class);

        $totalEdades = $repoCitas->createQueryBuilder('c')
            ->join('c.paciente', 'p')
            ->join('p.estudiante', 'e')
            ->join('e.persona', 'pe')
            ->where("c.periodo_academico = ".$periodoAcademico)
            ->select("date_part('year', age(pe.fecha_nacimiento)) as edad, count(c.id) as total")
            ->groupBy('edad')
            ->getQuery()
            ->getScalarResult();

        return $totalEdades;
    }

    /**
     * @Route("reportes/edad/{periodoAcademico}", name="reportes_edad", methods={"GET"})
     */
    public function consultasPorEdad($periodoAcademico): JsonResponse
    {
        $data = $this->conteoCitasEdad($periodoAcademico);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function conteoCitasEstrato($periodoAcademico): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Cita::class);

        $totalEstratos = $repoCitas->createQueryBuilder('c')
            ->join('c.paciente', 'p')
            ->join('p.estudiante', 'e')
            ->join('e.persona', 'pe')
            ->where("c.periodo_academico = ".$periodoAcademico)
            ->select("pe.estrato, count(c.id) as total")
            ->groupBy('pe.estrato')
            ->getQuery()
            ->getScalarResult();

        return $totalEstratos;
    }

    /**
     * @Route("reportes/estrato/{periodoAcademico}", name="reportes_estrato", methods={"GET"})
     */
    public function consultasPorEstrato($periodoAcademico): JsonResponse
    {
        $data = $this->conteoCitasEstrato($periodoAcademico);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function conteoCitasPrograma($periodoAcademico): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Cita::class);

        $totalProgramas = $repoCitas->createQueryBuilder('c')
            ->join('c.paciente', 'p')
            ->join('p.estudiante', 'e')
            ->join('e.programa', 'pr')
            ->where("c.periodo_academico = ".$periodoAcademico)
            ->select("pr.nombre as programa, count(c.id) as total")
            ->groupBy('programa')
            ->getQuery()
            ->getScalarResult();

        return $totalProgramas;
    }

    /**
     * @Route("reportes/programa/{periodoAcademico}", name="reportes_programa", methods={"GET"})
     */
    public function consultasPorPrograma($periodoAcademico): JsonResponse
    {
        $data = $this->conteoCitasPrograma($periodoAcademico);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function conteoCitasServicioAplicado($periodoAcademico): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Cita::class);

        $totalServiciosAplicados = $repoCitas->createQueryBuilder('c')
            ->join('c.servicio_aplicado', 'sa')
            ->where("c.periodo_academico = ".$periodoAcademico)
            ->select("sa.nombre as servicio_aplicado, count(c.id) as total")
            ->groupBy('servicio_aplicado')
            ->getQuery()
            ->getScalarResult();

        return $totalServiciosAplicados;
    }

    /**
     * @Route("reportes/servicio_aplicado/{periodoAcademico}", name="reportes_servicio_aplicado", methods={"GET"})
     */
    public function consultasPorServicioAplicado($periodoAcademico): JsonResponse
    {
        $data = $this->conteoCitasServicioAplicado($periodoAcademico);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function conteoCitasServicioComplementario($periodoAcademico): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Cita::class);

        $totalServiciosComplementarios = $repoCitas->createQueryBuilder('c')
            ->join('c.servicio_complementario', 'sc')
            ->where("c.periodo_academico = ".$periodoAcademico)
            ->select("sc.nombre as servicio_complementario, count(c.id) as total")
            ->groupBy('servicio_complementario')
            ->getQuery()
            ->getScalarResult();

        return $totalServiciosComplementarios;
    }

    /**
     * @Route("reportes/servicio_complementario/{periodoAcademico}", name="reportes_servicio_complementario", methods={"GET"})
     */
    public function consultasPorServicioComplementario($periodoAcademico): JsonResponse
    {
        $data = $this->conteoCitasServicioComplementario($periodoAcademico);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function conteoCitasTipoPersonalSalud($periodoAcademico): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Cita::class);

        $totalTiposPersonalSalud = $repoCitas->createQueryBuilder('c')
            ->join('c.personal_salud', 'ps')
            ->join('ps.tipo_personal_salud', 'tps')
            ->where("c.periodo_academico = ".$periodoAcademico)
            ->select("tps.nombre as tipo_personal_salud, count(c.id) as total")
            ->groupBy('tipo_personal_salud')
            ->getQuery()
            ->getScalarResult();

        return $totalTiposPersonalSalud;
    }

    /**
     * @Route("reportes/tipo_personal_salud/{periodoAcademico}", name="reportes_tipo_personal_salud", methods={"GET"})
     */
    public function consultasPorTipoPersonalSalud($periodoAcademico): JsonResponse
    {
        $data = $this->conteoCitasTipoPersonalSalud($periodoAcademico);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function conteoCitasDesercion($periodoAcademico): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Cita::class);

        $totalCitasDesercion = $repoCitas->createQueryBuilder('c')
            ->join('c.servicio_aplicado', 'sa')
            ->join('c.personal_salud', 'ps')
            ->join('ps.tipo_personal_salud', 'tps')
            ->where("sa.id = 6 AND c.periodo_academico = ".$periodoAcademico)
            ->select("tps.nombre as tipo_personal_salud, count(c.id) as total")
            ->groupBy('tipo_personal_salud')
            ->getQuery()
            ->getScalarResult();

        return $totalCitasDesercion;
    }

    /**
     * @Route("reportes/desercion_consulta/{periodoAcademico}", name="reportes_desercion_consulta", methods={"GET"})
     */
    public function consultasPorDesercion($periodoAcademico): JsonResponse
    {
        $data = $this->conteoCitasDesercion($periodoAcademico);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function conteoPacientesEPS(): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Paciente::class);

        $totalEPS = $repoCitas->createQueryBuilder('c')
            ->select("c.eps as eps, count(c.id) as total")
            ->groupBy('eps')
            ->getQuery()
            ->getScalarResult();

        return $totalEPS;
    }

    /**
     * @Route("reportes/eps/", name="reportes_eps", methods={"GET"})
     */
    public function pacientesPorEPS(): JsonResponse
    {
        $data = $this->conteoPacientesEPS();

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function conteoCitasTotalSemestre($periodoAcademico): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Cita::class);

        $totalSemestres = $repoCitas->createQueryBuilder('c')
            ->join('c.paciente', 'p')
            ->join('p.estudiante', 'e')
            ->join('e.semestre', 's')
            ->join('e.programa', 'pr')
            ->where("c.periodo_academico = ".$periodoAcademico)
            ->select("pr.nombre as programa, concat(s.numero, '-', s.grupo, '-', s.jornada) as semestre, count(c.id) as total")
            ->groupBy('programa')
            ->addGroupBy('semestre')
            ->getQuery()
            ->getScalarResult();

        return $totalSemestres;
    }

    /**
     * @Route("reportes/total_semestre/{periodoAcademico}", name="reportes_total_semestre", methods={"GET"})
     */
    public function consultasPorTotalSemestre($periodoAcademico): JsonResponse
    {
        $data = $this->conteoCitasTotalSemestre($periodoAcademico);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function conteoCitasSeguimiento($periodoAcademico): array
    {
        $em = $this->getDoctrine()->getManager();

        $repoCitas = $em->getRepository(Cita::class);

        $totalSeguimiento = $repoCitas->createQueryBuilder('c')
            ->join('c.personal_salud', 'ps')
            ->join('ps.tipo_personal_salud', 'tps')
            ->join('ps.persona', 'p')
            ->where("c.periodo_academico = ".$periodoAcademico)
            ->select("tps.nombre as tipo_personal_salud, trim(concat(p.primer_nombre, ' ', coalesce(p.segundo_nombre, ''), p.primer_apellido, ' ', coalesce(p.segundo_apellido, ''))) as personal_salud, count(c.id) as total")
            ->groupBy('tipo_personal_salud')
            ->addGroupBy('personal_salud')
            ->getQuery()
            ->getScalarResult();

        return $totalSeguimiento;
    }

    /**
     * @Route("reportes/seguimiento/{periodoAcademico}", name="reportes_seguimiento", methods={"GET"})
     */
    public function consultasPorSeguimiento($periodoAcademico): JsonResponse
    {
        $data = $this->conteoCitasSeguimiento($periodoAcademico);

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
