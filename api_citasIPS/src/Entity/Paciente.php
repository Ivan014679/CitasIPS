<?php

namespace App\Entity;

use App\Repository\PacienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PacienteRepository::class)
 * @ORM\Table(name="pacientes")
 * @UniqueEntity(
 *     fields="id_estudiante",
 *     errorPath="id_estudiante",
 *     message="El paciente ya se encuentra registrado."
 * )
 */
class Paciente
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigserial")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Estudiante::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_estudiante", nullable=false)
     * @Assert\Unique
     */
    private $estudiante;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $eps;

    /**
     * @ORM\ManyToOne(targetEntity=ModalidadAfiliacion::class, inversedBy="pacientes")
     * @ORM\JoinColumn(name="id_modalidad_afiliacion", nullable=false)
     */
    private $modalidad_afiliacion;

    /**
     * @ORM\OneToMany(targetEntity=Cita::class, mappedBy="id_paciente")
     */
    private $citas;

    public function __construct()
    {
        $this->citas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstudiante(): ?Estudiante
    {
        return $this->estudiante;
    }

    public function setEstudiante(Estudiante $estudiante): self
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    public function getEps(): ?string
    {
        return $this->eps;
    }

    public function setEps(string $eps): self
    {
        $this->eps = $eps;

        return $this;
    }

    public function getModalidadAfiliacion(): ?ModalidadAfiliacion
    {
        return $this->modalidad_afiliacion;
    }

    public function setModalidadAfiliacion(?ModalidadAfiliacion $modalidad_afiliacion): self
    {
        $this->modalidad_afiliacion = $modalidad_afiliacion;

        return $this;
    }

    /**
     * @return Collection|Cita[]
     */
    public function getCitas(): Collection
    {
        return $this->citas;
    }

    public function addCita(Cita $cita): self
    {
        if (!$this->citas->contains($cita)) {
            $this->citas[] = $cita;
            $cita->setPaciente($this);
        }

        return $this;
    }

    public function removeCita(Cita $cita): self
    {
        if ($this->citas->contains($cita)) {
            $this->citas->removeElement($cita);
            // set the owning side to null (unless already changed)
            if ($cita->getPaciente() === $this) {
                $cita->setPaciente(null);
            }
        }

        return $this;
    }
}
