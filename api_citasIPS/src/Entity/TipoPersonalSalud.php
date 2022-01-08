<?php

namespace App\Entity;

use App\Repository\TipoPersonalSaludRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoPersonalSaludRepository::class)
 * @ORM\Table(name="tipos_personal_salud")
 */
class TipoPersonalSalud
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
     * @ORM\OneToMany(targetEntity=PersonalSalud::class, mappedBy="id_tipo_personal_salud")
     */
    private $personalSalud;

    public function __construct()
    {
        $this->personalSalud = new ArrayCollection();
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
     * @return Collection|PersonalSalud[]
     */
    public function getPersonalSalud(): Collection
    {
        return $this->personalSalud;
    }

    public function addPersonalSalud(PersonalSalud $personalSalud): self
    {
        if (!$this->personalSalud->contains($personalSalud)) {
            $this->personalSalud[] = $personalSalud;
            $personalSalud->setTipoPersonalSalud($this);
        }

        return $this;
    }

    public function removePersonalSalud(PersonalSalud $personalSalud): self
    {
        if ($this->personalSalud->contains($personalSalud)) {
            $this->personalSalud->removeElement($personalSalud);
            // set the owning side to null (unless already changed)
            if ($personalSalud->getTipoPersonalSalud() === $this) {
                $personalSalud->setTipoPersonalSalud(null);
            }
        }

        return $this;
    }
}
