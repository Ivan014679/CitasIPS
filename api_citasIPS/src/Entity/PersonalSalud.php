<?php

namespace App\Entity;

use App\Repository\PersonalSaludRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PersonalSaludRepository::class)
 * @ORM\Table(name="personal_salud")
 * @UniqueEntity(
 *     fields="id_persona",
 *     errorPath="id_persona",
 *     message="El profesional ya se encuentra registrado."
 * )
 */
class PersonalSalud
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigserial")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Persona::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_persona", nullable=false)
     * @Assert\Unique
     */
    private $persona;

    /**
     * @ORM\ManyToOne(targetEntity=TipoPersonalSalud::class, inversedBy="personalSalud")
     * @ORM\JoinColumn(name="id_tipo_personal_salud", nullable=false)
     */
    private $tipo_personal_salud;

    /**
     * @ORM\OneToMany(targetEntity=Cita::class, mappedBy="personal_salud")
     */
    private $citas;

    /**
     * @ORM\ManyToMany(targetEntity=PeriodoAcademico::class)
     * @ORM\JoinTable(name="personal_salud_periodos_academicos",
     *      joinColumns={@ORM\JoinColumn(name="id_personal_salud", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_periodo_academico", referencedColumnName="id")}
     *      )
     */
    private $periodos_academicos;

    public function __construct()
    {
        $this->citas = new ArrayCollection();
        $this->periodos_academicos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersona(): ?Persona
    {
        return $this->persona;
    }

    public function setPersona(Persona $persona): self
    {
        $this->persona = $persona;

        return $this;
    }

    public function getTipoPersonalSalud(): ?TipoPersonalSalud
    {
        return $this->tipo_personal_salud;
    }

    public function setTipoPersonalSalud(?TipoPersonalSalud $tipo_personal_salud): self
    {
        $this->tipo_personal_salud = $tipo_personal_salud;

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
            $cita->setPersonalSalud($this);
        }

        return $this;
    }

    public function removeCita(Cita $cita): self
    {
        if ($this->citas->contains($cita)) {
            $this->citas->removeElement($cita);
            // set the owning side to null (unless already changed)
            if ($cita->getPersonalSalud() === $this) {
                $cita->setPersonalSalud(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PeriodoAcademico[]
     */
    public function getPeriodosAcademicos(): Collection
    {
        return $this->periodos_academicos;
    }

    public function setPeriodosAcademicos(?PeriodoAcademico $periodosAcademicos): self
    {
        $this->periodos_academicos = $periodosAcademicos;

        return $this;
    }

    public function addPeriodosAcademicos(PeriodoAcademico $periodosAcademicos): self
    {
        if (!$this->periodos_academicos->contains($periodosAcademicos)) {
            $this->periodos_academicos[] = $periodosAcademicos;
        }

        return $this;
    }

    public function removePeriodosAcademicos(PeriodoAcademico $periodosAcademicos): self
    {
        if ($this->periodos_academicos->contains($periodosAcademicos)) {
            $this->periodos_academicos->removeElement($periodosAcademicos);
        }

        return $this;
    }
}
