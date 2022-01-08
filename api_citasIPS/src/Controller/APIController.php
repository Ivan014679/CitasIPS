<?php

namespace App\Controller;

use App\Repository\PeriodoAcademicoRepository;
use App\Repository\TipoIdentificacionRepository;
use App\Repository\ProgramaRepository;
use App\Repository\ModalidadAfiliacionRepository;
use App\Repository\ParentezcoRepository;
use App\Repository\EstadoSeguimientoRepository;
use App\Repository\ServicioAplicadoRepository;
use App\Repository\PersonalSaludRepository;
use App\Repository\ServicioComplementarioRepository;
use App\Repository\CitaRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class APIController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class APIController
{
    private $tipoIdentificacionRepository;
    private $programaRepository;
    private $modalidadAfiliacionRepository;
    private $periodoAcademicoRepository;
    private $parentezcoRepository;
    private $estadoSeguimientoRepository;
    private $servicioAplicadoRepository;
    private $personalSaludRepository;
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
        $this->servicioComplementarioRepository = $servicioComplementarioRepository;
        $this->citaRepository = $citaRepository;
    }

    /**
     * @Route("periodos_academicos", name="obtener_periodos_academicos", methods={"GET"})
     */
    public function obtenerPeriodosAcademicos(): JsonResponse
    {
        $periodosAcademicos = $this->periodoAcademicoRepository->findAll();
        $data = [];

        foreach($periodosAcademicos as $periodoAcademico){
            $data[] = [
                'id' => $periodoAcademico->getId(),
                'anio' => $periodoAcademico->getAnio(),
                'periodo' => $periodoAcademico->getPeriodo(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("tipos_identificacion", name="obtener_tipos_identificacion", methods={"GET"})
     */
    public function obtenerTiposIdentificacion(): JsonResponse
    {
        $tiposIdentificacion = $this->tipoIdentificacionRepository->findAll();
        $data = [];

        foreach($tiposIdentificacion as $tipoIdentificacion){
            $data[] = [
                'id' => $tipoIdentificacion->getId(),
                'nombre' => $tipoIdentificacion->getNombre(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("programas", name="obtener_programas", methods={"GET"})
     */
    public function obtenerProgramas(): JsonResponse
    {
        $programas = $this->programaRepository->findAll();
        $data = [];

        foreach($programas as $programa){
            $data[] = [
                'id' => $programa->getId(),
                'nombre' => $programa->getNombre(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("modalidades_afiliacion", name="obtener_modalidades_afiliacion", methods={"GET"})
     */
    public function obtenerModalidadesAfiliacion(): JsonResponse
    {
        $modalidadesAfiliacion = $this->modalidadAfiliacionRepository->findAll();
        $data = [];

        foreach($modalidadesAfiliacion as $modalidadAfiliacion){
            $data[] = [
                'id' => $modalidadAfiliacion->getId(),
                'nombre' => $modalidadAfiliacion->getNombre(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("parentezcos", name="obtener_parentezcos", methods={"GET"})
     */
    public function obtenerParentezcos(): JsonResponse
    {
        $parentezcos = $this->parentezcoRepository->findAll();
        $data = [];

        foreach($parentezcos as $parentezco){
            $data[] = [
                'id' => $parentezco->getId(),
                'nombre' => $parentezco->getNombre(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("estados_seguimientos", name="obtener_estados_seguimientos", methods={"GET"})
     */
    public function obtenerEstadosSeguimientos(): JsonResponse
    {
        $estadosSeguimientos = $this->estadoSeguimientoRepository->findAll();
        $data = [];

        foreach($estadosSeguimientos as $estadoSeguimiento){
            $data[] = [
                'id' => $estadoSeguimiento->getId(),
                'nombre' => $estadoSeguimiento->getNombre(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("servicios_aplicados", name="obtener_servicios_aplicados", methods={"GET"})
     */
    public function obtenerServiciosAplicados(): JsonResponse
    {
        $serviciosAplicados = $this->servicioAplicadoRepository->findAll();
        $data = [];

        foreach($serviciosAplicados as $servicioAplicado){
            $data[] = [
                'id' => $servicioAplicado->getId(),
                'nombre' => $servicioAplicado->getNombre(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("servicios_complementarios", name="obtener_servicios_complementarios", methods={"GET"})
     */
    public function obtenerServiciosComplementarios(): JsonResponse
    {
        $serviciosComplementarios = $this->servicioComplementarioRepository->findAll();
        $data = [];

        foreach($serviciosComplementarios as $servicioComplementario){
            $data[] = [
                'id' => $servicioComplementario->getId(),
                'nombre' => $servicioComplementario->getNombre(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("horas_disponibles/{personalSalud},{fecha}", name="obtener_horas_cita", methods={"GET"})
     */
    public function obtenerHoras($personalSalud, $fecha): JsonResponse
    {
        $horas = $this->horas();

        $horasOcupadas = $this->horasOcupadas($personalSalud, $fecha);

        //Retorna las horas disponibles
        $horasDisponibles = array_diff($horas, $horasOcupadas);
        $data = [];
        foreach($horasDisponibles as $horaDisponible){
            $data[] = [
                0 => $horaDisponible,
                1 => date("h:i a", strtotime($horaDisponible)),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("horas_disponibles_y_propia/{personalSalud},{fecha},{hora}", name="obtener_horas_cita_propia", methods={"GET"})
     */
    public function obtenerHorasYPropia($personalSalud, $fecha, $hora): JsonResponse
    {
        $horas = $this->horas();

        $horasOcupadas = array_diff($this->horasOcupadas($personalSalud, $fecha), [$hora]);

        //Retorna las horas disponibles
        $horasDisponibles = array_diff($horas, $horasOcupadas);
        $data = [];
        foreach($horasDisponibles as $horaDisponible){
            $data[] = [
                0 => $horaDisponible,
                1 => date("h:i a", strtotime($horaDisponible)),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function horas(): array
    {
        //Se crea un array que contiene las horas para la cita, de 7:00am a 8:00pm saltando 30 minutos
        $horas = [];
        $horaInicio = strtotime("7:00:00");
        $horaFin = strtotime("20:00:00");
        $espacioHoras = 1800;
        while($horaInicio <= $horaFin){
            array_push($horas, date("H:i", $horaInicio));
            $horaInicio += $espacioHoras;
        }

        return $horas;
    }

    public function horasOcupadas($personalSalud, $fecha): array
    {
        //Se consulta a la base de datos las horas ocupadas de acuerdo a la fecha y se crea otro array de ello
        $fechaCitas = new \DateTime($fecha);
        $citasPersonalSalud = $this->personalSaludRepository->findOneBy(['id' => $personalSalud]);
        //Se obtiene las horas ocupadas del personal de la salud de acuerdo a la fecha dada
        $citasHora = $citasPersonalSalud->getCitas()->filter(function($cita) use ($fechaCitas) {
            return $cita->getFechaCita() == $fechaCitas;
        });
        $horasOcupadas = [];
        foreach($citasHora as $citaHora){
            array_push($horasOcupadas, $citaHora->getHoraCita()->format('H:i'));
        }

        return $horasOcupadas;
    }
}
