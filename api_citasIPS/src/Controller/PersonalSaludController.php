<?php

namespace App\Controller;

use App\Repository\PeriodoAcademicoRepository;
use App\Repository\PersonaRepository;
use App\Repository\EstudianteRepository;
use App\Repository\PracticasEstudianteRepository;
use App\Repository\PersonalSaludRepository;
use App\Repository\TipoPersonalSaludRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonalSaludController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class PersonalSaludController
{
    private $periodoAcademicoRepository;
    private $personaRepository;
    private $estudianteRepository;
    private $practicasEstudianteRepository;
    private $personalSaludRepository;
    private $tipoPersonalSaludRepository;

    public function __construct(PeriodoAcademicoRepository $periodoAcademicoRepository,
                                PersonaRepository $personaRepository,
                                EstudianteRepository $estudianteRepository,
                                PracticasEstudianteRepository $practicasEstudianteRepository,
                                PersonalSaludRepository $personalSaludRepository,
                                TipoPersonalSaludRepository $tipoPersonalSaludRepository)
    {
        $this->periodoAcademicoRepository = $periodoAcademicoRepository;
        $this->personaRepository = $personaRepository;
        $this->estudianteRepository = $estudianteRepository;
        $this->practicasEstudianteRepository = $practicasEstudianteRepository;
        $this->personalSaludRepository = $personalSaludRepository;
        $this->tipoPersonalSaludRepository = $tipoPersonalSaludRepository;
    }

    /**
     * @Route("personal_salud/{periodoAcademico}", name="obtener_personal_salud", methods={"GET"})
     */
    public function obtenerPersonalSalud($periodoAcademico): JsonResponse
    {
        $periodoAcademico = $this->periodoAcademicoRepository->findOneBy(['id' => $periodoAcademico]);
        $personalesSalud = $periodoAcademico->getPersonalSalud();
        $data = [];

        foreach($personalesSalud as $personalSalud){
            if($personalSalud->getPersona()->getSegundoNombre() != null){
                $nombres = $personalSalud->getPersona()->getPrimerNombre()." ".$personalSalud->getPersona()->getSegundoNombre();
            }else{
                $nombres = $personalSalud->getPersona()->getPrimerNombre();
            }
            if($personalSalud->getPersona()->getSegundoApellido() != null){
                $apellidos = $personalSalud->getPersona()->getPrimerApellido()." ".$personalSalud->getPersona()->getSegundoApellido();
            }else{
                $apellidos = $personalSalud->getPersona()->getPrimerApellido();
            }
            $data[] = [
                'id' => $personalSalud->getId(),
                'identificacion' => $personalSalud->getPersona()->getIdentificacion(),
                'tipo_identificacion' => $personalSalud->getPersona()->getTipoIdentificacion()->getNombre(),
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'tipo_personal_salud' => $personalSalud->getTipoPersonalSalud()->getId(),
                'n_tipo_personal_salud' => $personalSalud->getTipoPersonalSalud()->getNombre(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("tipos_personal_salud", name="obtener_tipos_personal_salud", methods={"GET"})
     */
    public function obtenerTiposPersonalSalud(): JsonResponse
    {
        $tiposPersonalSalud = $this->tipoPersonalSaludRepository->findAll();
        $data = [];

        foreach($tiposPersonalSalud as $tipoPersonalSalud){
            $data[] = [
                'id' => $tipoPersonalSalud->getId(),
                'nombre' => $tipoPersonalSalud->getNombre(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("profesionales_otros/{id}", name="obtener_profesionales_u_otros", methods={"GET"})
     */
    public function obtenerProfesionalesUOtros($id): JsonResponse
    {
        $persona = $this->personaRepository->findOneBy(['identificacion' => $id]);

        if($persona->getSegundoNombre() != null){
            $nombres = $persona->getPrimerNombre()." ".$persona->getSegundoNombre();
        }else{
            $nombres = $persona->getPrimerNombre();
        }
        if($persona->getSegundoApellido() != null){
            $apellidos = $persona->getPrimerApellido()." ".$persona->getSegundoApellido();
        }else{
            $apellidos = $persona->getPrimerApellido();
        }

        $data = [
            'id_persona' => $persona->getId(),
            'identificacion' => $persona->getIdentificacion(),
            'tipo_identificacion' => $persona->getTipoIdentificacion()->getNombre(),
            'nombres' => $nombres,
            'apellidos' => $apellidos,
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("practicantes/{periodoAcademico}", name="obtener_practicantes", methods={"GET"})
     */
    public function obtenerPracticantes($periodoAcademico): JsonResponse
    {
        $pAcademico = $this->periodoAcademicoRepository->findOneBy(['id' => $periodoAcademico]);
        $practicasEstudiante = $this->practicasEstudianteRepository->findByPeriodoAcademico($pAcademico->getAnio(), $pAcademico->getPeriodo());

        $data = [];

        foreach($practicasEstudiante as $practicaEstudiante){
            if($practicaEstudiante->getEstudiante()->getPersona()->getSegundoNombre() != null){
                $nombres = $practicaEstudiante->getEstudiante()->getPersona()->getPrimerNombre()." ".$practicaEstudiante->getEstudiante()->getPersona()->getSegundoNombre();
            }else{
                $nombres = $practicaEstudiante->getEstudiante()->getPersona()->getPrimerNombre();
            }
            if($practicaEstudiante->getEstudiante()->getPersona()->getSegundoApellido() != null){
                $apellidos = $practicaEstudiante->getEstudiante()->getPersona()->getPrimerApellido()." ".$practicaEstudiante->getEstudiante()->getPersona()->getSegundoApellido();
            }else{
                $apellidos = $practicaEstudiante->getEstudiante()->getPersona()->getPrimerApellido();
            }
            $data[] = [
                'id' => $practicaEstudiante->getId(),
                'id_persona' => $practicaEstudiante->getEstudiante()->getPersona()->getId(),
                'identificacion' => $practicaEstudiante->getEstudiante()->getPersona()->getIdentificacion(),
                'tipo_identificacion' => $practicaEstudiante->getEstudiante()->getPersona()->getTipoIdentificacion()->getNombre(),
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'fecha_inicio' => $practicaEstudiante->getFechaInicio()->format('Y-m-d'),
                'fecha_fin' => $practicaEstudiante->getFechaFin()->format('Y-m-d'),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("personal_salud", name="agregar_personal_salud", methods={"POST"})
     */
    public function agregarPersonalSalud(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $id_persona = $data['id_persona'];
        $id_tipo_personal_salud = $data['tipo_personal_salud'];
        $id_periodo_academico = $data['id_periodo_academico'];

        if (empty($id_persona) || empty($id_tipo_personal_salud) || empty($id_periodo_academico)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $result = $this->personalSaludRepository->agregarPersonalSalud($id_persona, $id_tipo_personal_salud, $id_periodo_academico);

        if($result == 'ERROR'){
            throw new ConflictHttpException('El profesional ya se encuentra agregado en este período académico.');
        }

        return new JsonResponse(['status' => 'Paciente registrado'], Response::HTTP_CREATED);
    }
}
