<?php

namespace App\Entity;

use App\Repository\ZonasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZonasRepository::class)]
class Zonas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    //CAMBIA EL NOMBRE DE LA COLUMNA
    #[ORM\Column(name: "COD_ZONA", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(length: 24)]
    private ?string $NOMBRE_ZONA = null;

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
}