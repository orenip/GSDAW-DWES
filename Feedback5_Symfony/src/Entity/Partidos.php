<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partidos
 *
 * @ORM\Table(name="partidos", indexes={@ORM\Index(name="FK_PARTIDO_EQUI1", columns={"COD_EQUIPO1"}), @ORM\Index(name="FK_PARTIDO_EQUI2", columns={"COD_EQUIPO2"})})
 * @ORM\Entity
 */
class Partidos
{
    /**
     * @var int
     *
     * @ORM\Column(name="COD_PARTIDO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codPartido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var int
     *
     * @ORM\Column(name="PUNTOS_EQUIPO1", type="integer", nullable=false)
     */
    private $puntosEquipo1;

    /**
     * @var int
     *
     * @ORM\Column(name="PUNTOS_EQUIPO2", type="integer", nullable=false)
     */
    private $puntosEquipo2;

    /**
     * @var \Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="COD_EQUIPO1", referencedColumnName="COD_EQUIPO")
     * })
     */
    private $codEquipo1;

    /**
     * @var \Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="COD_EQUIPO2", referencedColumnName="COD_EQUIPO")
     * })
     */
    private $codEquipo2;


}
