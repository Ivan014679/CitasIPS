<?php

namespace App\Controller;
use App\Repository\CitaRepository;
use App\Repository\PeriodoAcademicoRepository;
use App\Repository\ParentezcoRepository;
use App\Repository\EstadoSeguimientoRepository;
use App\Repository\ServicioAplicadoRepository;
use App\Repository\PersonalSaludRepository;
use App\Repository\ServicioComplementarioRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CitaController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class CitaController
{
    private $citaRepository;
    private $parentezcoRepository;
    private $estadoSeguimientoRepository;
    private $servicioAplicadoRepository;
    private $personalSaludRepository;
    private $servicioComplementarioRepository;

    public function __construct(CitaRepository $citaRepository,
                                PeriodoAcademicoRepository $periodoAcademicoRepository,
                                ParentezcoRepository $parentezcoRepository,
                                EstadoSeguimientoRepository $estadoSeguimientoRepository,
                                ServicioAplicadoRepository $servicioAplicadoRepository,
                                PersonalSaludRepository $personalSaludRepository,
                                ServicioComplementarioRepository $servicioComplementarioRepository)
    {
        $this->citaRepository = $citaRepository;
        $this->periodoAcademicoRepository = $periodoAcademicoRepository;
        $this->parentezcoRepository = $parentezcoRepository;
        $this->estadoSeguimientoRepository = $estadoSeguimientoRepository;
        $this->servicioAplicadoRepository = $servicioAplicadoRepository;
        $this->personalSaludRepository = $personalSaludRepository;
        $this->servicioComplementarioRepository = $servicioComplementarioRepository;
    }

    /**
     * @Route("citas", name="registrar_cita", methods={"POST"})
     */
    public function registrarCita(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $id_paciente = $data['id_paciente'];
        $acudiente = $data['acudiente'];
        $id_parentezco = $data['parentezco'];
        $fecha_cita = $data['fecha_cita'];
        $hora_cita = $data['hora_cita'];
        $id_estado_seguimiento = $data['estado_seguimiento'];
        $id_servicio_aplicado = $data['servicio_aplicado'];
        $id_personal_salud = $data['personal_salud'];
        $id_servicio_complementario = $data['servicio_complementario'];
        $observaciones = $data['observaciones'];
        $id_periodo_academico = $data['id_periodo_academico'];

        if (empty($id_paciente) || empty($acudiente) || empty($id_parentezco) || empty($fecha_cita) || empty($hora_cita) || empty($id_estado_seguimiento) || empty($id_servicio_aplicado) || empty($id_personal_salud) || empty($id_servicio_complementario) || empty($id_periodo_academico)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->citaRepository->guardarCita($id_paciente, $acudiente, $id_parentezco, $fecha_cita, $hora_cita, $id_estado_seguimiento, $id_servicio_aplicado, $id_personal_salud, $id_servicio_complementario, $observaciones, $id_periodo_academico);

        return new JsonResponse(['status' => 'Paciente registrado'], Response::HTTP_CREATED);
    }

    /**
     * @Route("citas/{periodoAcademico}", name="obtener_citas", methods={"GET"})
     */
    public function obtenerCitas($periodoAcademico): JsonResponse
    {
        $citas = $this->citaRepository->findBy(['periodo_academico' => $periodoAcademico]);
        $data = [];

        foreach($citas as $cita){
            if($cita->getPersonalSalud()->getPersona()->getSegundoNombre() != null){
                $nombres = $cita->getPersonalSalud()->getPersona()->getPrimerNombre()." ".$cita->getPersonalSalud()->getPersona()->getSegundoNombre();
            }else{
                $nombres = $cita->getPersonalSalud()->getPersona()->getPrimerNombre();
            }
            if($cita->getPersonalSalud()->getPersona()->getSegundoApellido() != null){
                $apellidos = $cita->getPersonalSalud()->getPersona()->getPrimerApellido()." ".$cita->getPersonalSalud()->getPersona()->getSegundoApellido();
            }else{
                $apellidos = $cita->getPersonalSalud()->getPersona()->getPrimerApellido();
            }
            $data[] = [
                'id' => $cita->getId(),
                'id_paciente' => $cita->getPaciente()->getId(),
                'identificacion' => $cita->getPaciente()->getEstudiante()->getPersona()->getIdentificacion(),
                'tipo_identificacion' => $cita->getPaciente()->getEstudiante()->getPersona()->getTipoIdentificacion()->getNombre(),
                'codigo' => $cita->getPaciente()->getEstudiante()->getCodigo(),
                'acudiente' => $cita->getAcudiente(),
                'parentezco' => $cita->getParentezco()->getId(),
                'fecha_cita' => $cita->getFechaCita()->format('Y-m-d'),
                'hora_cita' => $cita->getHoraCita()->format('h:i a'),
                'estado_seguimiento' => $cita->getEstadoSeguimiento()->getId(),
                'n_estado_seguimiento' => $cita->getEstadoSeguimiento()->getNombre(),
                'servicio_aplicado' => $cita->getServicioAplicado()->getId(),
                'n_servicio_aplicado' => $cita->getServicioAplicado()->getNombre(),
                'personal_salud' => $cita->getPersonalSalud()->getId(),
                'nombre_personal_salud' => $nombres.' '.$apellidos,
                'tipo_personal_salud' => $cita->getPersonalSalud()->getTipoPersonalSalud()->getId(),
                'servicio_complementario' => $cita->getServicioComplementario()->getId(),
                'observaciones' => $cita->getObservaciones(),
                'id_periodo_academico' => $cita->getPeriodoAcademico()->getId(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("cita/{id}", name="obtener_cita", methods={"GET"})
     */
    public function obtenerCita($id): JsonResponse
    {
        $cita = $this->citaRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $cita->getId(),
            'codigo' => $cita->getPaciente()->getEstudiante()->getCodigo(),
            'acudiente' => $cita->getAcudiente(),
            'parentezco' => $cita->getParentezco()->getId(),
            'fecha_cita' => $cita->getFechaCita()->format('Y-m-d'),
            'hora_cita' => $cita->getHoraCita()->format('H:i'),
            'estado_seguimiento' => $cita->getEstadoSeguimiento()->getId(),
            'servicio_aplicado' => $cita->getServicioAplicado()->getId(),
            'personal_salud' => $cita->getPersonalSalud()->getId(),
            'tipo_personal_salud' => $cita->getPersonalSalud()->getTipoPersonalSalud()->getId(),
            'servicio_complementario' => $cita->getServicioComplementario()->getId(),
            'observaciones' => $cita->getObservaciones(),
            'id_periodo_academico' => $cita->getPeriodoAcademico()->getId(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("cita/{id}", name="actualizar_cita", methods={"PUT"})
     */
    public function actualizarCita($id, Request $request): JsonResponse
    {
        $cita = $this->citaRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);
        $parentezco = $this->parentezcoRepository->findOneBy(['id' => $data['parentezco']]);
        $estado_seguimiento = $this->estadoSeguimientoRepository->findOneBy(['id' => $data['estado_seguimiento']]);
        $servicio_aplicado = $this->servicioAplicadoRepository->findOneBy(['id' => $data['servicio_aplicado']]);
        $personal_salud = $this->personalSaludRepository->findOneBy(['id' => $data['personal_salud']]);
        $servicio_complementario = $this->servicioComplementarioRepository->findOneBy(['id' => $data['servicio_complementario']]);

        empty($data['acudiente']) ? true : $cita->setAcudiente($data['acudiente']);
        empty($data['parentezco']) ? true : $cita->setParentezco($parentezco);
        empty($data['fecha_cita']) ? true : $cita->setFechaCita(new \DateTime($data['fecha_cita']));
        empty($data['hora_cita']) ? true : $cita->setHoraCita(new \DateTime($data['hora_cita']));
        empty($data['estado_seguimiento']) ? true : $cita->setEstadoSeguimiento($estado_seguimiento);
        empty($data['servicio_aplicado']) ? true : $cita->setServicioAplicado($servicio_aplicado);
        empty($data['personal_salud']) ? true : $cita->setPersonalSalud($personal_salud);
        empty($data['servicio_complementario']) ? true : $cita->setServicioComplementario($servicio_complementario);
        $cita->setObservaciones(str_replace(null, "", $data['observaciones']));

        $actualizarCita = $this->citaRepository->actualizarCita($cita);

        return new JsonResponse(['status' => 'Cita actualizada'], Response::HTTP_OK);
    }

    /**
     * @Route("cita/{id}", name="eliminar_cita", methods={"DELETE"})
     */
    public function eliminarCita($id): JsonResponse
    {
        $cita = $this->citaRepository->findOneBy(['id' => $id]);

        $this->citaRepository->eliminarCita($cita);

        return new JsonResponse(['status' => 'Cita eliminada'], Response::HTTP_OK);
    }
}
