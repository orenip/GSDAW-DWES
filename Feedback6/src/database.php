<?php
/**
 * Clase con la lógica para conectarse a la base de datos. 
 * Incluye métodos para recuperar registros, actualizar y borrarlos de cualquier tabla de la base de datos, además de poder filtrar las consultas.
 */
class Database
{
	private $connection;
	/**
	 * Atributo que indica la cantidad de registros por página a la hora de recuperar datos, para evitar que salgan todos y se colapse la API
	 * Para mostrar el segundo bloque de registros, se debe indicar en la URL el parámetro "page" con el valor 2
	 */
	private $results_page = 50;

	public function __construct(){
		$this->connection = new mysqli('localhost', 'root', '', 'apirestdwes', '3306');
//Se crea una conexión a la base de datos
		if($this->connection->connect_errno){
			echo 'Error de conexión a la base de datos';
			exit;
		}//Si no se puede conectar a la base de datos, muestra un mensaje de error y sale del script
	}

	/**
	 * Método para recuperar datos de una tabla, pudiendo indicar filtros con el parámetro $extra
	 */
	public function getDB($table, $extra = null)//El parámetro $extra es un array que contiene los campos y condiciones que se quieren aplicar a la consulta.
	//$extra = null en la definición de la función significa que el parámetro $extra es opcional y su valor predeterminado es null si no se proporciona un argumento al llamar a la función.
	{
		$page = 0;
		$query = "SELECT * FROM $table";

		if(isset($extra['page'])){
			$page = $extra['page'];
			unset($extra['page']);
		}//Si se ha recibido el parámetro page, se guarda en la variable $page y se elimina del array $extra, porque page no es un campo de la tabla

		if($extra != null){
			$query .= ' WHERE';//Si se ha recibido el parámetro $extra, se añade a la consulta

			foreach ($extra as $key => $condition) {
				$query .= ' '.$key.' = "'.$condition.'"';//Se añade el campo y la condición a la consulta
				if($extra[$key] != end($extra)){
					$query .= " AND ";//Si no es el último elemento del array, se añade un AND
				}
			}//Recorre el array $extra y va añadiendo a la consulta los campos y condiciones que se le han pasado
		}

		/**
		 * Aquí se paginan los resultados para evitar recuperar todos los registros de una tabla que contenga muchísimos
		 */
		if($page > 0){
			$since = (($page-1) * $this->results_page);//Calcula el registro desde el que se empieza a recuperar: página 1 -> desde el registro 0, página 2 -> desde el registro 50, página 3 -> desde el registro 100, etc.
			$query .= " LIMIT $since, $this->results_page";
		}//Si se ha recibido el parámetro page, se calcula el registro desde el que se empieza a recuperar y se añade a la consulta
		else{
			$query .= " LIMIT 0, $this->results_page";
		}//Si no se ha recibido el parámetro page, se añade a la consulta que se empieza a recuperar desde el registro 0

		$results = $this->connection->query($query);//Ejecuta la consulta
		$resultArray = array();

		foreach ($results as $value) {
			$resultArray[] = $value;
		}//Recorre los resultados y los va añadiendo a un array

		return $resultArray;//Devuelve el array con los resultados
	}

	/**
	 * Método para insertar un nuevo registro
	 */
	public function insertDB($table, $data)
	{
		$fields = implode(',', array_keys($data));//Crea un string con los campos de la tabla separados por comas
		$values = '"';//Comillas dobles para los valores
		$values .= implode('","', array_values($data));//Crea un string con los valores de los campos separados por comas
		$values .= '"';//Comillas dobles para los valores

		$query = "INSERT INTO $table (".$fields.') VALUES ('.$values.')';//Crea la consulta
		$this->connection->query($query);//Ejecuta la consulta

		return $this->connection->insert_id;//Devuelve el id del registro insertado
	}

	/**
	 * Método para actualizar un registro de la BD
	 * Hay que indicar el registro mediante un campo que sea clave primaria y que debe llamarse "id"
	 */
	public function updateDB($table, $id, $data)//El parámetro $data es un array que contiene los campos y valores que se quieren actualizar
	{	
		$query = "UPDATE $table SET ";//Crea la consulta
		foreach ($data as $key => $value) {//Recorre el array $data y va añadiendo a la consulta los campos y valores que se le han pasado
			$query .= "$key = '$value'";//Añade el campo y el valor a la consulta
			if(sizeof($data) > 1 && $key != array_key_last($data)){//Si el array tiene más de un elemento y no es el último elemento del array, se añade una coma
				$query .= " , ";//Si no es el último elemento del array, se añade una coma
			}
		}

		$query .= ' WHERE id = '.$id;//Añade el id del registro que se quiere actualizar a la consulta

		$this->connection->query($query);//Ejecuta la consulta

		if(!$this->connection->affected_rows){//Si no se ha actualizado ningún registro, devuelve 0
			return 0;
		}

		return $this->connection->affected_rows;//Devuelve el número de registros actualizados
	}

	/**
	 * Método para eliminar un registro de la BD
	 * Hay que indicar el registro mediante un campo que sea clave primaria y que debe llamarse "id"
	 */
	public function deleteDB($table, $id)//El parámetro $id es el id del registro que se quiere eliminar
	{
		$query = "DELETE FROM $table WHERE id = $id";//Crea la consulta
		$this->connection->query($query);//Ejecuta la consulta

		if(!$this->connection->affected_rows){//Si no se ha eliminado ningún registro, devuelve 0
			return 0;
		}

		return $this->connection->affected_rows;//Devuelve el número de registros eliminados
	}
}


?>