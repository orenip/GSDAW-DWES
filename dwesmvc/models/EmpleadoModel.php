<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class EmpleadoModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS
    private $codigo;
    private $nombre;
    private $salario;

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
	public function getCodigo() {
		return $this->codigo;
	}
	
	/**
	 * @param mixed $codigo 
	 * @return self
	 */
	public function setCodigo($codigo): self {
		$this->codigo = $codigo;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getNombre() {
		return $this->nombre;
	}
	
	/**
	 * @param mixed $nombre 
	 * @return self
	 */
	public function setNombre($nombre): self {
		$this->nombre = $nombre;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getSalario() {
		return $this->salario;
	}
	
	/**
	 * @param mixed $salario 
	 * @return self
	 */
	public function setSalario($salario): self {
		$this->salario = $salario;
		return $this;
	}

    // Método para obtener todos los registros de la tabla ITEMS
    // Devuelve un array de objetos de la clase ItemModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM empleado');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "EmpleadoModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
    public function getById($codigo)
    {
        $gsent = $this->db->prepare('SELECT * FROM empleado WHERE codigo = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "EmpleadoModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto ItemModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if ($this->getById($this->getCodigo()) == null) {
            $consulta = $this->db->prepare('INSERT INTO empleado(codigo,nombre,salario) VALUES (?,?,?)');
            $consulta->bindParam(1, $this->codigo);
            $consulta->bindParam(2, $this->nombre);
            $consulta->bindParam(3, $this->salario);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE empleado SET nombre=?, salario=? WHERE codigo=?');
            $consulta->bindParam(1, $this->nombre);
            $consulta->bindParam(2, $this->salario);
            $consulta->bindParam(3, $this->codigo);
            
            $consulta->execute();
        }
    }

    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM empleado WHERE codigo=?');
        $consulta->bindParam(1, $this->codigo);
        $consulta->execute();
    }

	
}
?>