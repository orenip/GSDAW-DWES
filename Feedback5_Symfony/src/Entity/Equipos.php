<?php

namespace App\Entity;

use App\Repository\EquiposRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquiposRepository::class)]
class Equipos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $NOMBRE_EQUIPO = null;

    #[ORM\Column]
    private ?int $PRESUPUESTO = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $FECHA_FUNDACION = null;

    #[ORM\Column]
    private ?int $TITULOS = null;

    #[ORM\ManyToOne(inversedBy: 'lista_equipos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Zonas $ZONA = null;

    #[ORM\OneToMany(mappedBy: 'EQUIPO', targetEntity: Jugadores::class)]
    private Collection $lista_jugadores;

    #[ORM\OneToMany(mappedBy: 'COD_EQUIPO1', targetEntity: Partidos::class)]
    private Collection $lista_partidos;

    #[ORM\OneToMany(mappedBy: 'COD_EQUIPO2', targetEntity: Partidos::class)]
    private Collection $lista_partidos2;

    public function __construct()
    {
        $this->lista_jugadores = new ArrayCollection();
        $this->lista_partidos = new ArrayCollection();
        $this->lista_partidos2 = new ArrayCollection();
    }

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

    public function getZONA(): ?Zonas
    {
        return $this->ZONA;
    }

    public function setZONA(?Zonas $ZONA): static
    {
        $this->ZONA = $ZONA;

        return $this;
    }

    /**
     * @return Collection<int, Jugadores>
     */
    public function getListaJugadores(): Collection
    {
        return $this->lista_jugadores;
    }

    public function addListaJugadore(Jugadores $listaJugadore): static
    {
        if (!$this->lista_jugadores->contains($listaJugadore)) {
            $this->lista_jugadores->add($listaJugadore);
            $listaJugadore->setEQUIPO($this);
        }

        return $this;
    }

    public function removeListaJugadore(Jugadores $listaJugadore): static
    {
        if ($this->lista_jugadores->removeElement($listaJugadore)) {
            // set the owning side to null (unless already changed)
            if ($listaJugadore->getEQUIPO() === $this) {
                $listaJugadore->setEQUIPO(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Partidos>
     */
    public function getListaPartidos(): Collection
    {
        return $this->lista_partidos;
    }

    public function addListaPartido(Partidos $listaPartido): static
    {
        if (!$this->lista_partidos->contains($listaPartido)) {
            $this->lista_partidos->add($listaPartido);
            $listaPartido->setCODEQUIPO1($this);
        }

        return $this;
    }

    public function removeListaPartido(Partidos $listaPartido): static
    {
        if ($this->lista_partidos->removeElement($listaPartido)) {
            // set the owning side to null (unless already changed)
            if ($listaPartido->getCODEQUIPO1() === $this) {
                $listaPartido->setCODEQUIPO1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Partidos>
     */
    public function getListaPartidos2(): Collection
    {
        return $this->lista_partidos2;
    }

    public function addListaPartidos2(Partidos $listaPartidos2): static
    {
        if (!$this->lista_partidos2->contains($listaPartidos2)) {
            $this->lista_partidos2->add($listaPartidos2);
            $listaPartidos2->setCODEQUIPO2($this);
        }

        return $this;
    }

    public function removeListaPartidos2(Partidos $listaPartidos2): static
    {
        if ($this->lista_partidos2->removeElement($listaPartidos2)) {
            // set the owning side to null (unless already changed)
            if ($listaPartidos2->getCODEQUIPO2() === $this) {
                $listaPartidos2->setCODEQUIPO2(null);
            }
        }

        return $this;
    }
}
