<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipos
 *
 * @ORM\Table(name="equipos", indexes={@ORM\Index(name="FK_EQUIPO_ZONA", columns={"ZONA"})})
 * @ORM\Entity
 */
class Equipos
{
    /**
     * @var int
     *
     * @ORM\Column(name="COD_EQUIPO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codEquipo;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_EQUIPO", type="string", length=40, nullable=false)
     */
    private $nombreEquipo;

    /**
     * @var int
     *
     * @ORM\Column(name="PRESUPUESTO", type="integer", nullable=false)
     */
    private $presupuesto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FUNDACION", type="date", nullable=false)
     */
    private $fechaFundacion;

    /**
     * @var int
     *
     * @ORM\Column(name="TITULOS", type="integer", nullable=false)
     */
    private $titulos;

    /**
     * @var \Zonas
     *
     * @ORM\ManyToOne(targetEntity="Zonas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ZONA", referencedColumnName="COD_ZONA")
     * })
     */
    private $zona;


}
