<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class PartidosModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS
    private $COD_PARTIDO;
    private $FECHA;
    private $COD_EQUIPO1;
    private $COD_EQUIPO2;
    private $PUNTOS_EQUIPO1;
    private $PUNTOS_EQUIPO2;

    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
   /**
	 * @return mixed
	 */
	public function getCOD_PARTIDO() {
		return $this->COD_PARTIDO;
	}
	
	/**
	 * @param mixed $COD_PARTIDO 
	 * @return self
	 */
	public function setCOD_PARTIDO($COD_PARTIDO): self {
		$this->COD_PARTIDO = $COD_PARTIDO;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getFECHA() {
		return $this->FECHA;
	}
	
	/**
	 * @param mixed $FECHA 
	 * @return self
	 */
	public function setFECHA($FECHA): self {
		$this->FECHA = $FECHA;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getCOD_EQUIPO1() {
		return $this->COD_EQUIPO1;
	}
	
	/**
	 * @param mixed $COD_EQUIPO1 
	 * @return self
	 */
	public function setCOD_EQUIPO1($COD_EQUIPO1): self {
		$this->COD_EQUIPO1 = $COD_EQUIPO1;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getCOD_EQUIPO2() {
		return $this->COD_EQUIPO2;
	}
	
	/**
	 * @param mixed $COD_EQUIPO2 
	 * @return self
	 */
	public function setCOD_EQUIPO2($COD_EQUIPO2): self {
		$this->COD_EQUIPO2 = $COD_EQUIPO2;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getPUNTOS_EQUIPO1() {
		return $this->PUNTOS_EQUIPO1;
	}
	
	/**
	 * @param mixed $PUNTOS_EQUIPO1 
	 * @return self
	 */
	public function setPUNTOS_EQUIPO1($PUNTOS_EQUIPO1): self {
		$this->PUNTOS_EQUIPO1 = $PUNTOS_EQUIPO1;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getPUNTOS_EQUIPO2() {
		return $this->PUNTOS_EQUIPO2;
	}
	
	/**
	 * @param mixed $PUNTOS_EQUIPO2 
	 * @return self
	 */
	public function setPUNTOS_EQUIPO2($PUNTOS_EQUIPO2): self {
		$this->PUNTOS_EQUIPO2 = $PUNTOS_EQUIPO2;
		return $this;
	}

    // Método para obtener todos los registros de la tabla ITEMS
    // Devuelve un array de objetos de la clase ItemModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM PARTIDOS');
        $consulta->execute();

        // OJO!! El fetchAll() funcionará correctamente siempre que el nombre
        // de los atributos de la clase coincida con los campos de la tabla
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "PartidosModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


	public function getEquiposList()
    {
        $consulta = $this->db->prepare('SELECT * FROM EQUIPOS');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

     // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
	 public function getById($codigo)
	 {
		 $gsent = $this->db->prepare('SELECT * FROM PARTIDOS WHERE COD_PARTIDO = ?');
		 $gsent->bindParam(1, $codigo);
		 $gsent->execute();
 
		 $gsent->setFetchMode(PDO::FETCH_CLASS, "PartidosModel");
		 $resultado = $gsent->fetch();
 
		 return $resultado;
	 }

    // Método que almacena en BD un objeto ItemModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if ($this->getById($this->getCOD_PARTIDO()) == null) {
            $consulta = $this->db->prepare('INSERT INTO PARTIDOS(COD_PARTIDO,FECHA,COD_EQUIPO1,COD_EQUIPO2,PUNTOS_EQUIPO1,PUNTOS_EQUIPO2) VALUES (?,?,?,?,?,?)');
            $consulta->bindParam(1, $this->COD_PARTIDO);
            $consulta->bindParam(2, $this->FECHA);
			$consulta->bindParam(3, $this->COD_EQUIPO1);
			$consulta->bindParam(4, $this->COD_EQUIPO2);
			$consulta->bindParam(5, $this->PUNTOS_EQUIPO1);
			$consulta->bindParam(6, $this->PUNTOS_EQUIPO2);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE PARTIDOS SET FECHA=?,COD_EQUIPO1=?,COD_EQUIPO2=?,PUNTOS_EQUIPO1=?,PUNTOS_EQUIPO2=? WHERE COD_PARTIDO=?');
			$consulta->bindParam(1, $this->FECHA);
			$consulta->bindParam(2, $this->COD_EQUIPO1);
			$consulta->bindParam(3, $this->COD_EQUIPO2);
			$consulta->bindParam(4, $this->PUNTOS_EQUIPO1);
			$consulta->bindParam(5, $this->PUNTOS_EQUIPO2);
			$consulta->bindParam(6, $this->COD_PARTIDO);
            $consulta->execute();
        }
    }

    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM PARTIDOS WHERE COD_PARTIDO=?');
        $consulta->bindParam(1, $this->COD_PARTIDO);
        $consulta->execute();
    }
}
?>