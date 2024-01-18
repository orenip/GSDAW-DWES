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
    #[ORM\Column(name: "COD_PARTIDO")]
    private ?int $id = null;

    #[ORM\Column(name: "FECHA", type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $FECHA = null;

    #[ORM\Column(name: "PUNTOS_EQUIPO1")]
    private ?int $PUNTOS_EQUIPO1 = null;

    #[ORM\Column(name: "PUNTOS_EQUIPO2")]
    private ?int $PUNTOS_EQUIPO2 = null;

    /**
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumn(name="COD_EQUIPO1", referencedColumnName="COD_EQUIPO")
     */
    private ?Equipos $equipo1 = null;

    /**
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumn(name="COD_EQUIPO2", referencedColumnName="COD_EQUIPO")
     */
    private ?Equipos $equipo2 = null;

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

    public function getEquipo1(): ?Equipos
    {
        return $this->equipo1;
    }

    public function setEquipo1(?Equipos $equipo1): static
    {
        $this->equipo1 = $equipo1;

        return $this;
    }

    public function getEquipo2(): ?Equipos
    {
        return $this->equipo2;
    }

    public function setEquipo2(?Equipos $equipo2): static
    {
        $this->equipo2 = $equipo2;

        return $this;
    }
}