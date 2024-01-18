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
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $NOMBRE_JUGADOR = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $FECHA_NACIMIENTO = null;

    #[ORM\Column]
    private ?int $ESTATURA = null;

    #[ORM\Column(length: 12)]
    private ?string $POSICION = null;

    #[ORM\ManyToOne(inversedBy: 'lista_jugadores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipos $EQUIPO = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEQUIPO(): ?Equipos
    {
        return $this->EQUIPO;
    }

    public function setEQUIPO(?Equipos $EQUIPO): static
    {
        $this->EQUIPO = $EQUIPO;

        return $this;
    }
}
