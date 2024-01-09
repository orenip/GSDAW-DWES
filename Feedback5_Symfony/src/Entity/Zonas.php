<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zonas
 *
 * @ORM\Table(name="zonas")
 * @ORM\Entity
 */
class Zonas
{
    /**
     * @var int
     *
     * @ORM\Column(name="COD_ZONA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codZona;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ZONA", type="string", length=24, nullable=false)
     */
    private $nombreZona;


}
