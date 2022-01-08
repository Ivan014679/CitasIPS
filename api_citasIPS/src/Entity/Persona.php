<?php

namespace App\Entity;

use App\Repository\PersonaRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonaRepository::class)
 * @ORM\Table(name="personas")
 */
class Persona
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigserial")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $identificacion;

    /**
     * @ORM\ManyToOne(targetEntity=TipoIdentificacion::class)
     * @ORM\JoinColumn(name="id_tipo_identificacion", nullable=false)
     */
    private $tipo_identificacion;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $primer_nombre;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $segundo_nombre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $primer_apellido;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $segundo_apellido;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $genero;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $lugar_expedicion;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_nacimiento;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $celular;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $correo_electronico;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $barrio;

    /**
     * @ORM\Column(type="smallint")
     */
    private $estrato;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentificacion(): ?string
    {
        return $this->identificacion;
    }

    public function setIdentificacion(string $identificacion): self
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    public function getTipoIdentificacion(): ?TipoIdentificacion
    {
        return $this->tipo_identificacion;
    }

    public function setTipoIdentificacion(?TipoIdentificacion $tipo_identificacion): self
    {
        $this->tipo_identificacion = $tipo_identificacion;

        return $this;
    }

    public function getPrimerNombre(): ?string
    {
        return $this->primer_nombre;
    }

    public function setPrimerNombre(string $primer_nombre): self
    {
        $this->primer_nombre = $primer_nombre;

        return $this;
    }

    public function getSegundoNombre(): ?string
    {
        return $this->segundo_nombre;
    }

    public function setSegundoNombre(string $segundo_nombre): self
    {
        $this->segundo_nombre = $segundo_nombre;

        return $this;
    }

    public function getPrimerApellido(): ?string
    {
        return $this->primer_apellido;
    }

    public function setPrimerApellido(string $primer_apellido): self
    {
        $this->primer_apellido = $primer_apellido;

        return $this;
    }

    public function getSegundoApellido(): ?string
    {
        return $this->segundo_apellido;
    }

    public function setSegundoApellido(string $segundo_apellido): self
    {
        $this->segundo_apellido = $segundo_apellido;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getLugarExpedicion(): ?string
    {
        return $this->lugar_expedicion;
    }

    public function setLugarExpedicion(string $lugar_expedicion): self
    {
        $this->lugar_expedicion = $lugar_expedicion;

        return $this;
    }

    public function getFechaNacimiento(): ?DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(DateTimeInterface $fecha_nacimiento): self
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getCorreoElectronico(): ?string
    {
        return $this->correo_electronico;
    }

    public function setCorreoElectronico(string $correo_electronico): self
    {
        $this->correo_electronico = $correo_electronico;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getBarrio(): ?string
    {
        return $this->barrio;
    }

    public function setBarrio(string $barrio): self
    {
        $this->barrio = $barrio;

        return $this;
    }

    public function getEstrato(): ?int
    {
        return $this->estrato;
    }

    public function setEstrato(int $estrato): self
    {
        $this->estrato = $estrato;

        return $this;
    }
}
