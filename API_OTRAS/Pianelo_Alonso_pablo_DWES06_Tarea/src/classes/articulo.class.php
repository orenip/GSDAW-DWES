<?php
/**
 * Clase para el modelo que representa a la tabla "player".
 */
require_once 'src/response.php';
require_once 'src/database.php';

class Articulo extends Database
{
	/**
	 * Atributo que indica la tabla asociada a la clase del modelo
	 */
	private $table = 'articulo';
	private $pk ='art_id';


	/**
	 * Array con los campos de la tabla que se pueden usar como filtro en la URL para recuperar registros
	 */
	private $allowedConditions_get = array(
		'art_id',
		'art_nombre',
		'art_categoria',
		'page'
	);

	/**
	 * Array con los campos de la tabla que se pueden proporcionar en la URL para insertar registros
	 */
	private $allowedConditions_insert = array(
		'art_nombre',
		'art_categoria',
		'art_cantidad'
	);

	/**
	 * Método para validar los datos que se mandan para insertar un registro, comprobar campos obligatorios, valores válidos, etc.
	 */
	private function validate($data)
	{

		if (!isset($data['art_nombre']) || empty($data['art_nombre'])) {//Comprueba si se ha recibido el campo player_name y si no está vacío
			$response = array(
				'result' => 'error',
				'details' => 'El campo art_nombre es obligatorio'
			);//Si no se ha recibido el campo player_name o está vacío, se crea un array con el resultado de la petición

			Response::result(400, $response);//Se llama al método result de la clase Response, pasándole como parámetros el código de respuesta y el array con el resultado de la petición
			exit;
		}

		return true;//Si todo va bien, devuelve true
	}

	/**
	 * Método para recuperar registros, pudiendo indicar algunos filtros 
	 */
	public function get($params)
	{
		foreach ($params as $key => $param) {
			if (!in_array($key, $this->allowedConditions_get)) {
				unset($params[$key]);
				$response = array(
					'result' => 'error',
					'details' => 'Error en la solicitud'
				);//Antes de hacer el get, comprueba que el parámetro que se le pasa está en el array de allowedConditions_get, si no lo está, lo elimina del array y devuelve un error

				Response::result(400, $response); //Genera una respuesta con el código de error 400 y el array $response
				exit;
			}
		}

		$players = parent::getDB($this->table, $params);//Si todo va bien, llama al método getDB de la clase Database, pasándole como parámetros la tabla y los parámetros que se le han pasado a la función get

		return $players;//Devuelve el array con los resultados
	}

	/**
	 * Método para guardar un registro en la base de datos, recibe como parámetro el JSON con los datos a insertar
	 */
	public function insert($params)
	{
		foreach ($params as $key => $param) {
			if (!in_array($key, $this->allowedConditions_insert)) {
				unset($params[$key]);
				$response = array(
					'result' => 'error',
					'details' => 'Error en la solicitud'
				);//Antes de hacer el insert, comprueba que el parámetro que se le pasa está en el array de allowedConditions_insert, si no lo está, lo elimina del array y devuelve un error

				Response::result(400, $response);//Genera una respuesta con el código de error 400 y el array $response
				exit;
			}//
		}

		if ($this->validate($params)) {//Si todo va bien, llama al método validate, pasándole como parámetro el array $params
			return parent::insertDB($this->table, $params);
		}//Si todo va bien, llama al método insertDB de la clase Database (parent de player, que player extends Database), 
		//pasándole como parámetros la tabla y los parámetros que se le han pasado a la función insert
	}

	/**
	 * Método para actualizar un registro en la base de datos, se indica el id del registro que se quiere actualizar
	 */
	public function updatePut($id, $params) {
		foreach ($params as $key => $parm) {
			if (!in_array($key, $this->allowedConditions_insert)) {
				unset($params[$key]);
				$response = array(
					'result' => 'error',
					'details' => 'Error en la solicitud'
				);

				Response::result(400, $response);
				exit;
			}
		}

		if ($this->validate($params)) {
			$affected_rows = parent::updateDB($this->table, $id, $this->pk, $params);

			if ($affected_rows == 0) {
				$response = array(
					'result' => 'error',
					'details' => 'No hubo cambios'
				);

				Response::result(200, $response);
				exit;
			}
		}
	}


	
	public function updatePatch($id, $params) {
		foreach ($params as $key => $parm) {
			if (!in_array($key, $this->allowedConditions_insert)) {
				unset($params[$key]);
				$response = array(
					'result' => 'error',
					'details' => 'Error en la solicitud'
				);

				Response::result(400, $response);
				exit;
			}
		}

		$affected_rows = parent::updateDB($this->table, $id, $this->pk, $params);

		if ($affected_rows == 0) {
			$response = array(
				'result' => 'error',
				'details' => 'No hubo cambios'
			);

			Response::result(200, $response);
			exit;
		}
	}

	/**
	 * Método para borrar un registro de la base de datos, se indica el id del registro que queremos eliminar
	 */
	public function delete($id)//Recibe como parámetro el id del registro que se quiere eliminar
	{
		$affected_rows = parent::deleteDB($this->table,$this->pk, $id);//Llama al método deleteDB de la clase Database (parent de player, que player extends Database), pasándole como parámetros la tabla y el id del registro que se quiere eliminar

		if ($affected_rows == 0) {//Si no se ha eliminado ningún registro, devuelve un error
			$response = array(
				'result' => 'error',
				'details' => 'No hubo cambios'
			);

			Response::result(200, $response);//Genera una respuesta con el código de error 200 y el array $response
			exit;
		}
	}
}

?>