<?php

namespace App\Controller;

use App\Repository\PacienteRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PacienteController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class PacienteController
{
    private $pacienteRepository;

    public function __construct(PacienteRepository $pacienteRepository)
    {
        $this->pacienteRepository = $pacienteRepository;
    }

    /**
     * @Route("pacientes", name="obtener_pacientes", methods={"GET"})
     */
    public function obtenerPacientes(): JsonResponse
    {
        $pacientes = $this->pacienteRepository->findAll();
        $data = [];

        foreach($pacientes as $paciente){
            if($paciente->getEstudiante()->getPersona()->getSegundoNombre() != null){
                $nombres = $paciente->getEstudiante()->getPersona()->getPrimerNombre()." ".$paciente->getEstudiante()->getPersona()->getSegundoNombre();
            }else{
                $nombres = $paciente->getEstudiante()->getPersona()->getPrimerNombre();
            }
            if($paciente->getEstudiante()->getPersona()->getSegundoApellido() != null){
                $apellidos = $paciente->getEstudiante()->getPersona()->getPrimerApellido()." ".$paciente->getEstudiante()->getPersona()->getSegundoApellido();
            }else{
                $apellidos = $paciente->getEstudiante()->getPersona()->getPrimerApellido();
            }
            $data[] = [
                'id' => $paciente->getId(),
                'identificacion' => $paciente->getEstudiante()->getPersona()->getIdentificacion(),
                'tipo_identificacion' => $paciente->getEstudiante()->getPersona()->getTipoIdentificacion()->getNombre(),
                'codigo' => $paciente->getEstudiante()->getCodigo(),
                'nombres' => $nombres,
                'apellidos' => $apellidos,
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("pacientes", name="registrar_paciente", methods={"POST"})
     */
    public function registrarPaciente(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $id_estudiante = $data['id_estudiante'];
        $id_modalidad_afiliacion = $data['modalidad_afiliacion'];
        $eps = $data['eps'];

        if (empty($id_estudiante) || empty($id_modalidad_afiliacion) || empty($eps)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->pacienteRepository->guardarPaciente($id_estudiante, $id_modalidad_afiliacion, $eps);

        return new JsonResponse(['status' => 'Paciente registrado'], Response::HTTP_CREATED);
    }

    /**
     * @Route("pacientes/{id_estudiante}", name="obtener_paciente", methods={"GET"})
     */
    public function obtenerPaciente($id_estudiante): JsonResponse
    {
        $paciente = $this->pacienteRepository->findOneBy(['estudiante' => $id_estudiante]);

        if($paciente->getEstudiante()->getPersona()->getSegundoNombre() != null){
            $nombres = $paciente->getEstudiante()->getPersona()->getPrimerNombre()." ".$paciente->getEstudiante()->getPersona()->getSegundoNombre();
        }else{
            $nombres = $paciente->getEstudiante()->getPersona()->getPrimerNombre();
        }
        if($paciente->getEstudiante()->getPersona()->getSegundoApellido() != null){
            $apellidos = $paciente->getEstudiante()->getPersona()->getPrimerApellido()." ".$paciente->getEstudiante()->getPersona()->getSegundoApellido();
        }else{
            $apellidos = $paciente->getEstudiante()->getPersona()->getPrimerApellido();
        }

        $data = [
            'id' => $paciente->getId(),
            'identificacion' => $paciente->getEstudiante()->getPersona()->getIdentificacion(),
            'tipo_identificacion' => $paciente->getEstudiante()->getPersona()->getTipoIdentificacion()->getNombre(),
            'codigo' => $paciente->getEstudiante()->getCodigo(),
            'nombres' => $nombres,
            'apellidos' => $apellidos,
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }
}