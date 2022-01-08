<?php

namespace App\Entity;

use App\Repository\PracticasEstudianteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PracticasEstudianteRepository::class)
 * @ORM\Table(name="zeus.pract_practicas_estudiantes")
 */
class PracticasEstudiante
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigserial")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Estudiante::class, inversedBy="practicas")
     * @ORM\JoinColumn(name="id_estudiante", nullable=false)
     */
    private $estudiante;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_inicio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_fin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstudiante(): ?Estudiante
    {
        return $this->estudiante;
    }

    public function setEstudiante(?Estudiante $estudiante): self
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getActiva(): ?bool
    {
        return $this->estudiante;
    }

    public function setActiva(?bool $activa): self
    {
        $this->activa = $activa;

        return $this;
    }
}
