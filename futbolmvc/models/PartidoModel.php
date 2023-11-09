<?php
class PartidoModel
{
	protected $db;

	private $PARTIDO_ID;
	private $JORNADA_ID;
	private $LOCAL_ID;
	private $VISITANTE_ID;
	private $MARCADOR_LOCAL;
	private $MARCADOR_VISITANTE;
	private $ESTADO;

	public function __construct()
	{
		//Traemos la única instancia de PDO
		$this->db = SPDO::singleton();
	}

	public function getPartidoId() {
		return $this->PARTIDO_ID;
	}

	public function getLocalId()
	{
		return $this->LOCAL_ID;
	}

	public function getVisitanteId()
	{
		return $this->VISITANTE_ID;
	}

	public function getMarcadorLocal()
	{
		return $this->MARCADOR_LOCAL;
	}


	public function getMarcadorVisitante()
	{
		return $this->MARCADOR_VISITANTE;
	}

	public function getEstado() {
		return $this->ESTADO;
	}

	public function getPartidosByJornada($codigo)
	{
		//realizamos la consulta de todos los items
		$consulta = $this->db->prepare('select *, A.EQUIPO AS LOCAL, B.EQUIPO AS VISITANTE from liga_jornadas, liga_partidos, liga_equipos A, liga_equipos B WHERE liga_jornadas.JORNADA_ID = liga_partidos.JORNADA_ID AND A.EQUIPO_ID = liga_partidos.LOCAL_ID AND B.EQUIPO_ID = liga_partidos.VISITANTE_ID AND liga_jornadas.JORNADA_ID = ?');
		$consulta->bindParam(1, $codigo);
		$consulta->execute();

		$resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "PartidoModel");

		return $resultado;
	}
	public function getClasificacion()
	{
		$equipos = array();
		$puntos = array();
		$consulta = $this->db->prepare('select * from liga_equipos order by EQUIPO_ID');
		$consulta->execute();
		while ($row = $consulta->fetch()) {
			$equipos[$row['EQUIPO_ID']] = $row['EQUIPO'];
			$puntos[$row['EQUIPO_ID']] = 0;
		}

		//realizamos la consulta de todos los items
		$consulta = $this->db->prepare('select * from liga_partidos');
		$consulta->execute();

		while ($row = $consulta->fetch()) {
			if ($row['MARCADOR_LOCAL'] > $row['MARCADOR_VISITANTE'])
				$puntos[$row['LOCAL_ID']] += 3;
			elseif ($row['MARCADOR_LOCAL'] < $row['MARCADOR_VISITANTE'])
				$puntos[$row['VISITANTE_ID']] += 3;
			else {
				$puntos[$row['VISITANTE_ID']] += 1;
				$puntos[$row['LOCAL_ID']] += 1;
			}
		}

		array_multisort($puntos, SORT_DESC, $equipos);

		$clasificacion = array();

		for ($i = 0; $i < count($puntos); $i++)
			$clasificacion[$equipos[$i]] = $puntos[$i];

		return $clasificacion;
	}
}