<?php

namespace App\Entity;

use App\Repository\ModalidadAfiliacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModalidadAfiliacionRepository::class)
 * @ORM\Table(name="modalidades_afiliacion")
 */
class ModalidadAfiliacion
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
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Paciente::class, mappedBy="id_modalidad_afiliacion")
     */
    private $pacientes;

    public function __construct()
    {
        $this->pacientes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection|Paciente[]
     */
    public function getPacientes(): Collection
    {
        return $this->pacientes;
    }

    public function addPaciente(Paciente $paciente): self
    {
        if (!$this->pacientes->contains($paciente)) {
            $this->pacientes[] = $paciente;
            $paciente->setModalidadAfiliacion($this);
        }

        return $this;
    }

    public function removePaciente(Paciente $paciente): self
    {
        if ($this->pacientes->contains($paciente)) {
            $this->pacientes->removeElement($paciente);
            // set the owning side to null (unless already changed)
            if ($paciente->getModalidadAfiliacion() === $this) {
                $paciente->setModalidadAfiliacion(null);
            }
        }

        return $this;
    }
}
