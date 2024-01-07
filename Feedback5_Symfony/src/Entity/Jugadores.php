<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jugadores
 *
 * @ORM\Table(name="jugadores", indexes={@ORM\Index(name="FK_JUGADOR_EQUI", columns={"EQUIPO"})})
 * @ORM\Entity
 */
class Jugadores
{
    /**
     * @var int
     *
     * @ORM\Column(name="COD_JUGADOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codJugador;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_JUGADOR", type="string", length=40, nullable=false)
     */
    private $nombreJugador;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_NACIMIENTO", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var int
     *
     * @ORM\Column(name="ESTATURA", type="integer", nullable=false)
     */
    private $estatura;

    /**
     * @var string
     *
     * @ORM\Column(name="POSICION", type="string", length=12, nullable=false)
     */
    private $posicion;

    /**
     * @var \Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EQUIPO", referencedColumnName="COD_EQUIPO")
     * })
     */
    private $equipo;


}
