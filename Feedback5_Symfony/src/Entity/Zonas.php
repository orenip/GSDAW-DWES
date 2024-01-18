<?php

namespace App\Entity;

use App\Repository\ZonasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZonasRepository::class)]
class Zonas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 24)]
    private ?string $NOMBRE_ZONA = null;

    #[ORM\OneToMany(mappedBy: 'ZONA', targetEntity: Equipos::class)]
    private Collection $lista_equipos;

    public function __construct()
    {
        $this->lista_equipos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNOMBREZONA(): ?string
    {
        return $this->NOMBRE_ZONA;
    }

    public function setNOMBREZONA(string $NOMBRE_ZONA): static
    {
        $this->NOMBRE_ZONA = $NOMBRE_ZONA;

        return $this;
    }

    /**
     * @return Collection<int, Equipos>
     */
    public function getListaEquipos(): Collection
    {
        return $this->lista_equipos;
    }

    public function addListaEquipo(Equipos $listaEquipo): static
    {
        if (!$this->lista_equipos->contains($listaEquipo)) {
            $this->lista_equipos->add($listaEquipo);
            $listaEquipo->setZONA($this);
        }

        return $this;
    }

    public function removeListaEquipo(Equipos $listaEquipo): static
    {
        if ($this->lista_equipos->removeElement($listaEquipo)) {
            // set the owning side to null (unless already changed)
            if ($listaEquipo->getZONA() === $this) {
                $listaEquipo->setZONA(null);
            }
        }

        return $this;
    }
}
