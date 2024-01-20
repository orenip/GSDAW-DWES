<?php

namespace App\Entity;

use App\Repository\JugadoresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JugadoresRepository::class)]
class Jugadores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $COD_JUGADOR = null;

    #[ORM\Column(name: "NOMBRE_JUGADOR", length: 40)]
    private ?string $NOMBRE_JUGADOR = null;

    #[ORM\Column(name: "FECHA_NACIMIENTO", type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $FECHA_NACIMIENTO = null;

    #[ORM\Column(name: "ESTATURA")]
    private ?int $ESTATURA = null;

    #[ORM\Column(name: "POSICION", length: 12)]
    private ?string $POSICION = null;

    /**
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumn(name="EQUIPO", referencedColumnName="COD_EQUIPO")
     */
    private ?Equipos $equipo = null;

    public function getId(): ?int
    {
        return $this->COD_JUGADOR;
    }

    public function getNOMBREJUGADOR(): ?string
    {
        return $this->NOMBRE_JUGADOR;
    }

    public function setNOMBREJUGADOR(string $NOMBRE_JUGADOR): static
    {
        $this->NOMBRE_JUGADOR = $NOMBRE_JUGADOR;

        return $this;
    }

    public function getFECHANACIMIENTO(): ?\DateTimeInterface
    {
        return $this->FECHA_NACIMIENTO;
    }

    public function setFECHANACIMIENTO(\DateTimeInterface $FECHA_NACIMIENTO): static
    {
        $this->FECHA_NACIMIENTO = $FECHA_NACIMIENTO;

        return $this;
    }

    public function getESTATURA(): ?int
    {
        return $this->ESTATURA;
    }

    public function setESTATURA(int $ESTATURA): static
    {
        $this->ESTATURA = $ESTATURA;

        return $this;
    }

    public function getPOSICION(): ?string
    {
        return $this->POSICION;
    }

    public function setPOSICION(string $POSICION): static
    {
        $this->POSICION = $POSICION;

        return $this;
    }

    public function getEquipo(): ?Equipos
    {
        return $this->equipo;
    }

    public function setEquipo(?Equipos $equipo): static
    {
        $this->equipo = $equipo;

        return $this;
    }
}