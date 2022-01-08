<?php

namespace App\Entity;

use App\Repository\CitaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CitaRepository::class)
 * @ORM\Table(name="citas")
 */
class Cita
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigserial")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Paciente::class, inversedBy="citas")
     * @ORM\JoinColumn(name="id_paciente", nullable=false)
     */
    private $paciente;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $acudiente;

    /**
     * @ORM\ManyToOne(targetEntity=Parentezco::class)
     * @ORM\JoinColumn(name="id_parentezco", nullable=false)
     */
    private $parentezco;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_cita;

    /**
     * @ORM\Column(type="time")
     */
    private $hora_cita;

    /**
     * @ORM\ManyToOne(targetEntity=EstadoSeguimiento::class, inversedBy="citas")
     * @ORM\JoinColumn(name="id_estado_seguimiento", nullable=false)
     */
    private $estado_seguimiento;

    /**
     * @ORM\ManyToOne(targetEntity=ServicioAplicado::class, inversedBy="citas")
     * @ORM\JoinColumn(name="id_servicio_aplicado", nullable=false)
     */
    private $servicio_aplicado;

    /**
     * @ORM\ManyToOne(targetEntity=PersonalSalud::class, inversedBy="citas")
     * @ORM\JoinColumn(name="id_personal_salud", nullable=false)
     */
    private $personal_salud;

    /**
     * @ORM\ManyToOne(targetEntity=ServicioComplementario::class, inversedBy="citas")
     * @ORM\JoinColumn(name="id_servicio_complementario", nullable=false)
     */
    private $servicio_complementario;

    /**
     * @ORM\ManyToOne(targetEntity=PeriodoAcademico::class)
     * @ORM\JoinColumn(name="id_periodo_academico", nullable=false)
     */
    private $periodo_academico;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observaciones;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaciente(): ?Paciente
    {
        return $this->paciente;
    }

    public function setPaciente(?Paciente $paciente): self
    {
        $this->paciente = $paciente;

        return $this;
    }

    public function getAcudiente(): ?string
    {
        return $this->acudiente;
    }

    public function setAcudiente(string $acudiente): self
    {
        $this->acudiente = $acudiente;

        return $this;
    }

    public function getParentezco(): ?Parentezco
    {
        return $this->parentezco;
    }

    public function setParentezco(?Parentezco $parentezco): self
    {
        $this->parentezco = $parentezco;

        return $this;
    }

    public function getFechaCita(): ?\DateTimeInterface
    {
        return $this->fecha_cita;
    }

    public function setFechaCita(\DateTimeInterface $fecha_cita): self
    {
        $this->fecha_cita = $fecha_cita;

        return $this;
    }

    public function getHoraCita(): ?\DateTimeInterface
    {
        return $this->hora_cita;
    }

    public function setHoraCita(\DateTimeInterface $hora_cita): self
    {
        $this->hora_cita = $hora_cita;

        return $this;
    }

    public function getEstadoSeguimiento(): ?EstadoSeguimiento
    {
        return $this->estado_seguimiento;
    }

    public function setEstadoSeguimiento(?EstadoSeguimiento $estado_seguimiento): self
    {
        $this->estado_seguimiento = $estado_seguimiento;

        return $this;
    }

    public function getServicioAplicado(): ?ServicioAplicado
    {
        return $this->servicio_aplicado;
    }

    public function setServicioAplicado(?ServicioAplicado $servicio_aplicado): self
    {
        $this->servicio_aplicado = $servicio_aplicado;

        return $this;
    }

    public function getPersonalSalud(): ?PersonalSalud
    {
        return $this->personal_salud;
    }

    public function setPersonalSalud(?PersonalSalud $personal_salud): self
    {
        $this->personal_salud = $personal_salud;

        return $this;
    }

    public function getServicioComplementario(): ?ServicioComplementario
    {
        return $this->servicio_complementario;
    }

    public function setServicioComplementario(?ServicioComplementario $servicio_complementario): self
    {
        $this->servicio_complementario = $servicio_complementario;

        return $this;
    }

    public function getPeriodoAcademico(): ?PeriodoAcademico
    {
        return $this->periodo_academico;
    }

    public function setPeriodoAcademico(?PeriodoAcademico $periodo_academico): self
    {
        $this->periodo_academico = $periodo_academico;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }
}
