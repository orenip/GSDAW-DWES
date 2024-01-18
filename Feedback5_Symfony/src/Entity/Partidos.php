<?php

namespace App\Entity;

use App\Repository\PartidosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartidosRepository::class)]
class Partidos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $FECHA = null;

    #[ORM\Column]
    private ?int $PUNTOS_EQUIPO1 = null;

    #[ORM\Column]
    private ?int $PUNTOS_EQUIPO2 = null;

    #[ORM\ManyToOne(inversedBy: 'lista_partidos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipos $COD_EQUIPO1 = null;

    #[ORM\ManyToOne(inversedBy: 'lista_partidos2')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipos $COD_EQUIPO2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFECHA(): ?\DateTimeInterface
    {
        return $this->FECHA;
    }

    public function setFECHA(\DateTimeInterface $FECHA): static
    {
        $this->FECHA = $FECHA;

        return $this;
    }

    public function getPUNTOSEQUIPO1(): ?int
    {
        return $this->PUNTOS_EQUIPO1;
    }

    public function setPUNTOSEQUIPO1(int $PUNTOS_EQUIPO1): static
    {
        $this->PUNTOS_EQUIPO1 = $PUNTOS_EQUIPO1;

        return $this;
    }

    public function getPUNTOSEQUIPO2(): ?int
    {
        return $this->PUNTOS_EQUIPO2;
    }

    public function setPUNTOSEQUIPO2(int $PUNTOS_EQUIPO2): static
    {
        $this->PUNTOS_EQUIPO2 = $PUNTOS_EQUIPO2;

        return $this;
    }

    public function getCODEQUIPO1(): ?Equipos
    {
        return $this->COD_EQUIPO1;
    }

    public function setCODEQUIPO1(?Equipos $COD_EQUIPO1): static
    {
        $this->COD_EQUIPO1 = $COD_EQUIPO1;

        return $this;
    }

    public function getCODEQUIPO2(): ?Equipos
    {
        return $this->COD_EQUIPO2;
    }

    public function setCODEQUIPO2(?Equipos $COD_EQUIPO2): static
    {
        $this->COD_EQUIPO2 = $COD_EQUIPO2;

        return $this;
    }
}
