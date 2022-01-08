<?php

namespace App\Entity;

use App\Repository\PeriodoAcademicoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeriodoAcademicoRepository::class)
 * @ORM\Table(name="periodos_academicos")
 */
class PeriodoAcademico
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigserial")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $anio;

    /**
     * @ORM\Column(type="smallint")
     */
    private $periodo;

    /**
     * @ORM\ManyToMany(targetEntity=PersonalSalud::class)
     * @ORM\JoinTable(name="personal_salud_periodos_academicos",
     *      joinColumns={@ORM\JoinColumn(name="id_periodo_academico", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_personal_salud", referencedColumnName="id")}
     *      )
     */
    private $personal_salud;

    /**
     * @ORM\OneToMany(targetEntity=Cita::class, mappedBy="id_periodo_academico")
     */
    private $citas;

    public function __construct()
    {
        $this->personal_salud = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnio(): ?int
    {
        return $this->anio;
    }

    public function setAnio(int $anio): self
    {
        $this->anio = $anio;

        return $this;
    }

    public function getPeriodo(): ?int
    {
        return $this->periodo;
    }

    public function setPeriodo(int $periodo): self
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * @return Collection|PersonalSalud[]
     */
    public function getPersonalSalud(): Collection
    {
        return $this->personal_salud;
    }

    /**
     * @return Collection|PersonalSalud[]
     */
    public function getCitas(): Collection
    {
        return $this->citas;
    }

    public function addPersonalSalud(PersonalSalud $personalSalud): self
    {
        if (!$this->personal_salud->contains($personalSalud)) {
            $this->personal_salud[] = $personalSalud;
        }

        return $this;
    }

    public function removePersonalSalud(PersonalSalud $personalSalud): self
    {
        if ($this->personal_salud->contains($personalSalud)) {
            $this->personal_salud->removeElement($personalSalud);
        }

        return $this;
    }
}
