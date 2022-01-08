<?php

namespace App\Entity;

use App\Repository\ServicioComplementarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServicioComplementarioRepository::class)
 * @ORM\Table(name="servicios_complementarios")
 */
class ServicioComplementario
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
     * @ORM\OneToMany(targetEntity=Cita::class, mappedBy="id_servicio_complementario")
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
            $cita->setServicioComplementario($this);
        }

        return $this;
    }

    public function removeCita(Cita $cita): self
    {
        if ($this->citas->contains($cita)) {
            $this->citas->removeElement($cita);
            // set the owning side to null (unless already changed)
            if ($cita->getServicioComplementario() === $this) {
                $cita->setServicioComplementario(null);
            }
        }

        return $this;
    }
}
