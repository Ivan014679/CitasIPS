<?php

namespace App\Controller;

use App\Entity\Programa;
use App\Repository\EstudianteRepository;
use App\Repository\PersonaRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EstudianteController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class EstudianteController
{
    private $estudianteRepository;
    private $personaRepository;

    public function __construct(EstudianteRepository $estudianteRepository, PersonaRepository $personaRepository)
    {
        $this->estudianteRepository = $estudianteRepository;
        $this->personaRepository = $personaRepository;
    }

    /**
     * @Route("estudiantes/{id},{type}", name="obtener_estudiante", methods={"GET"})
     */
    public function obtenerEstudiante($id, $type): JsonResponse
    {
        if ($type == "id") {
            $persona = $this->personaRepository->findOneBy(['identificacion' => $id]);
            $estudiante = $this->estudianteRepository->findOneBy(['persona' => $persona->getId()]);
        } elseif ($type == "cod") {
            $estudiante = $this->estudianteRepository->findOneBy(['codigo' => $id]);
        }

        if($estudiante->getPersona()->getSegundoNombre() != null){
            $nombres = $estudiante->getPersona()->getPrimerNombre()." ".$estudiante->getPersona()->getSegundoNombre();
        }else{
            $nombres = $estudiante->getPersona()->getPrimerNombre();
        }
        if($estudiante->getPersona()->getSegundoApellido() != null){
            $apellidos = $estudiante->getPersona()->getPrimerApellido()." ".$estudiante->getPersona()->getSegundoApellido();
        }else{
            $apellidos = $estudiante->getPersona()->getPrimerApellido();
        }

        $data = [
            'id' => $estudiante->getId(),
            'identificacion' => $estudiante->getPersona()->getIdentificacion(),
            'tipo_identificacion' => $estudiante->getPersona()->getTipoIdentificacion()->getId(),
            'expedicion' => $estudiante->getPersona()->getLugarExpedicion(),
            'codigo' => $estudiante->getCodigo(),
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'genero' => $estudiante->getPersona()->getGenero(),
            'fecha_nacimiento' => $estudiante->getPersona()->getFechaNacimiento()->format('Y-m-d'),
            'telefono' => $estudiante->getPersona()->getTelefono(),
            'celular' => $estudiante->getPersona()->getCelular(),
            'correo_electronico' => $estudiante->getPersona()->getCorreoElectronico(),
            'direccion' => $estudiante->getPersona()->getDireccion(),
            'barrio' => $estudiante->getPersona()->getBarrio(),
            'estrato' => $estudiante->getPersona()->getEstrato(),
            'programa' => $estudiante->getPrograma()->getId(),
            'semestre' => $estudiante->getSemestre()->getNumero().'-'.$estudiante->getSemestre()->getGrupo().'-'.$estudiante->getSemestre()->getJornada(),
            'id_estudiante' => $estudiante->getId(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
