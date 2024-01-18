<?php

namespace App\Entity;

use App\Repository\EquiposRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquiposRepository::class)]
class Equipos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "COD_EQUIPO")]
    private ?int $id = null;

    #[ORM\Column(name: "NOMBRE_EQUIPO", length: 40)]
    private ?string $NOMBRE_EQUIPO = null;

    #[ORM\Column(name: "PRESUPUESTO")]
    private ?int $PRESUPUESTO = null;

    #[ORM\Column(name: "FECHA_FUNDACION", type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $FECHA_FUNDACION = null;

    #[ORM\Column(name: "TITULOS")]
    private ?int $TITULOS = null;

    /**
     * @ORM\ManyToOne(targetEntity="Zonas")
     * @ORM\JoinColumn(name="ZONA", referencedColumnName="COD_ZONA")
     */
    private ?Zonas $zona = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNOMBREEQUIPO(): ?string
    {
        return $this->NOMBRE_EQUIPO;
    }

    public function setNOMBREEQUIPO(string $NOMBRE_EQUIPO): static
    {
        $this->NOMBRE_EQUIPO = $NOMBRE_EQUIPO;

        return $this;
    }

    public function getPRESUPUESTO(): ?int
    {
        return $this->PRESUPUESTO;
    }

    public function setPRESUPUESTO(int $PRESUPUESTO): static
    {
        $this->PRESUPUESTO = $PRESUPUESTO;

        return $this;
    }

    public function getFECHAFUNDACION(): ?\DateTimeInterface
    {
        return $this->FECHA_FUNDACION;
    }

    public function setFECHAFUNDACION(\DateTimeInterface $FECHA_FUNDACION): static
    {
        $this->FECHA_FUNDACION = $FECHA_FUNDACION;

        return $this;
    }

    public function getTITULOS(): ?int
    {
        return $this->TITULOS;
    }

    public function setTITULOS(int $TITULOS): static
    {
        $this->TITULOS = $TITULOS;

        return $this;
    }

    public function getZona(): ?Zonas
    {
        return $this->zona;
    }

    public function setZona(?Zonas $zona): static
    {
        $this->zona = $zona;

        return $this;
    }
}