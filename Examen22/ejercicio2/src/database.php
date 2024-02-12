<?php
/**
 * Clase con la lógica para conectarse a la base de datos. 
 * Incluye métodos para recuperar registros, actualizar y borrarlos de cualquier tabla de la base de datos, además de poder filtrar las consultas.
 */
class Database
{
	/**
	 * Atributo con la conexión a la base de datos
	 */
	private $connection;

	/**
	 * Atributo con la PK de la tabla
	 */
	private $table_pk;

	/**
	 * Atributo que indica la cantidad de registros por página a la hora de recuperar datos
	 */
	private $results_page = 50;

	/**
	 * Constructor de la clase
	 */
	public function __construct($clave){
		$this->connection = new mysqli('127.0.0.1', 'root', '', 'fct', '3306');

		if($this->connection->connect_errno){
			echo 'Error de conexión a la base de datos';
			exit;
		}

		$this->table_pk = $clave;
	}

	/**
	 * Método para recuperar datos de una tabla, pudiendo indicar filtros con el parámetro $extra
	 */
	public function getDB($table, $extra = null)
	{
		$page = 0;
		$query = "SELECT * FROM $table";

		if(isset($extra['page'])){
			$page = $extra['page'];
			unset($extra['page']);
		}

		if($extra != null){
			$query .= ' WHERE';

			foreach ($extra as $key => $condition) {
				$query .= ' '.$key.' = "'.$condition.'"';
				if($extra[$key] != end($extra)){
					$query .= " AND ";
				}
			}
		}

		/**
		 * Aquí se paginan los resultados para evitar recuperar todos los registros de una tabla que contenga muchísimos
		 */
		if($page > 0){
			$since = (($page-1) * $this->results_page);
			$query .= " LIMIT $since, $this->results_page";
		}
		else{
			$query .= " LIMIT 0, $this->results_page";
		}

		$results = $this->connection->query($query);
		$resultArray = array();

		foreach ($results as $value) {
			$resultArray[] = $value;
		}

		return $resultArray;
	}

	/**
	 * Método para insertar un nuevo registro
	 */
	public function insertDB($table, $data)
	{
		$fields = implode(',', array_keys($data));
		$values = '"';
		$values .= implode('","', array_values($data));
		$values .= '"';

		$query = "INSERT INTO $table (".$fields.') VALUES ('.$values.')';
		$this->connection->query($query);

		return $this->connection->insert_id;
	}

	/**
	 * Método para actualizar un registro de la BD
	 * Hay que indicar el registro mediante un campo que sea clave primaria y que debe llamarse "id"
	 */
	public function updateDB($table, $id, $data)
	{	
		$query = "UPDATE $table SET ";
		foreach ($data as $key => $value) {
			$query .= "$key = '$value'";
			if(sizeof($data) > 1 && $key != array_key_last($data)){
				$query .= " , ";
			}
		}

		$query .= " WHERE " . $this->table_pk . " = " . $id;

		$this->connection->query($query);

		if(!$this->connection->affected_rows){
			return 0;
		}

		return $this->connection->affected_rows;
	}

	/**
	 * Método para eliminar un registro de la BD
	 */
	public function deleteDB($table, $id)
	{
		$query = 'DELETE FROM '.$table.' WHERE '.$this->table_pk.' = '.$id;
		$this->connection->query($query);

		if(!$this->connection->affected_rows){
			return 0;
		}

		return $this->connection->affected_rows;
	}

}


?>