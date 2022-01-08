<?php

namespace App\Entity;

use App\Repository\EstudianteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstudianteRepository::class)
 * @ORM\Table(name="estudiantes")
 */
class Estudiante
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigserial")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $codigo;

    /**
     * @ORM\ManyToOne(targetEntity=Programa::class)
     * @ORM\JoinColumn(name="id_programa", nullable=false)
     */
    private $programa;

    /**
     * @ORM\ManyToOne(targetEntity=Semestre::class)
     * @ORM\JoinColumn(name="id_semestre", nullable=false)
     */
    private $semestre;

    /**
     * @ORM\OneToOne(targetEntity=Persona::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_persona", nullable=false)
     */
    private $persona;

    /**
     * @ORM\OneToMany(targetEntity=PracticasEstudiante::class, mappedBy="estudiante")
     */
    private $practicas;

    public function __construct()
    {
        $this->fecha_inicio = new ArrayCollection();
        $this->practicas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getPrograma(): ?Programa
    {
        return $this->programa;
    }

    public function setPrograma(?Programa $programa): self
    {
        $this->programa = $programa;

        return $this;
    }

    public function getSemestre(): ?Semestre
    {
        return $this->semestre;
    }

    public function setSemestre(?Semestre $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
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

    /**
     * @return Collection|PracticasEstudiante[]
     */
    public function getPracticas(): Collection
    {
        return $this->practicas;
    }

    public function addPractica(PracticasEstudiante $practica): self
    {
        if (!$this->practicas->contains($practica)) {
            $this->practicas[] = $practica;
            $practica->setEstudiante($this);
        }

        return $this;
    }

    public function removePractica(PracticasEstudiante $practica): self
    {
        if ($this->practicas->contains($practica)) {
            $this->practicas->removeElement($practica);
            // set the owning side to null (unless already changed)
            if ($practica->getEstudiante() === $this) {
                $practica->setEstudiante(null);
            }
        }

        return $this;
    }
}
