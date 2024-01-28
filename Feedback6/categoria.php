<?php
/**
 *	Script que se usa en los endpoints para trabajar con registros de la tabla categorias
 *	La clase "categoria.class.php" es la clase del modelo, que representa a un jugador de la tabla
*/
require_once 'src/response.php';
require_once 'src/classes/categoria.class.php';

$categoria = new Categoria();

/**
 * Se mira el tipo de petición que ha llegado a la API y dependiendo de ello se realiza una u otra accción
 */
switch ($_SERVER['REQUEST_METHOD']) {//Se mira el tipo de petición que ha llegado a la API: GET, POST, PUT o DELETE
	/**
	 * Si se ha recibido un GET se llama al método get() del modelo y se le pasan los parámetros recibidos por GET en la petición
	 */
	case 'GET':
		$params = $_GET;//Asigna el array superglobal $_GET a la variable $params

		$categorias = $categoria->get($params); //Esta línea de código en PHP está llamando al método get en el objeto $player y pasando el array $params como argumento. El resultado de esta llamada al método se almacena en la variable $players.

		$response = array(
			'result' => 'ok',
			'categorias' => $categorias
		);//Se crea un array con el resultado de la petición

		Response::result(200, $response);//Se llama al método result de la clase Response, pasándole como parámetros el código de respuesta y el array con el resultado de la petición
		break;//Se sale del switch
		
	/**
	 * Si se recibe un POST, se comprueba si se han recibido parámetros y en caso afirmativo se usa el método insert() del modelo. Se utiliza para crear nuevos registros en la base de datos
	 */
	case 'POST':
		$params = json_decode(file_get_contents('php://input'), true);//Se recogen los parámetros que se han enviado en la petición POST
/*Esta línea de código en PHP está leyendo los datos de la entrada estándar (en este caso, el cuerpo de una solicitud HTTP POST), 
decodificándolos de JSON a un array de PHP y asignándolos a la variable $params.
Desglosemos cada parte:
file_get_contents('php://input'): file_get_contents es una función de PHP que lee un archivo en una cadena. 
'php://input' es una secuencia de lectura que permite leer datos brutos del cuerpo de la solicitud. 
En el caso de una solicitud POST, estos datos serían los datos enviados en el cuerpo de la solicitud.
json_decode( ..., true): json_decode es una función de PHP que toma una cadena JSON y la convierte en una variable de PHP. 
El segundo argumento true indica que los objetos JSON se deben convertir en arrays asociativos de PHP.
Por lo tanto, esta línea de código se utiliza para recoger los datos enviados en el cuerpo de una solicitud POST 
y convertirlos en un array de PHP que se puede manipular más fácilmente en el código.*/
		if(!isset($params)){
			$response = array(
				'result' => 'error',
				'details' => 'Error en la solicitud'
			);//Comprobamos que exista el array $params, si no existe, se crea un array con un mensaje de error

			Response::result(400, $response);//Se llama al método result de la clase Response, pasándole como parámetros el código de respuesta y el array con el resultado de la petición
			exit;
		}

		$insert_id = $categoria->insert($params);//Se llama al método insert() del modelo, pasándole como parámetro el array $params

		$response = array(
			'result' => 'ok',
			'insert_id' => $insert_id
		);//Se crea un array con el resultado de la petición

		Response::result(201, $response);//Se llama al método result de la clase Response, pasándole como parámetros el código de respuesta y el array con el resultado de la petición
		break;

	/**
	 * Cuando es PUT, comprobamos si la petición lleva el id del jugador que hay que actualizar. En caso afirmativo se usa el método update() del modelo.
	 * Se utiliza para actualizar registros en la base de datos. En la URL se debe indicar el id del jugador que se quiere actualizar. Como por ejemplo: http://localhost/apirestcrud/player.php?id=1
	 */
	case 'PUT':
		$params = json_decode(file_get_contents('php://input'), true);//Se recogen los parámetros que se han enviado en la petición PUT

		if(!isset($params) || !isset($_GET['cat_id']) || empty($_GET['cat_id'])){//Comprobamos que exista el array $params y el parámetro id, si no existe alguno de los dos, se crea un array con un mensaje de error
			$response = array(
				'result' => 'error',
				'details' => 'Error en la solicitud'
			);//Comprobamos que exista el array $params y el parámetro id, si no existe alguno de los dos, se crea un array con un mensaje de error

			Response::result(400, $response);//Se llama al método result de la clase Response, pasándole como parámetros el código de respuesta y el array con el resultado de la petición
			exit;
		}

		$categoria->update($_GET['cat_id'], $params);//Se llama al método update() del modelo, pasándole como parámetros el id del jugador y el array $params

		$response = array(
			'result' => 'ok'
		);

		Response::result(200, $response);
		break;

	/**
	 * Cuando se solicita un DELETE se comprueba que se envíe un id de jugador. En caso afirmativo se utiliza el método delete() del modelo.
	 */
	case 'DELETE':
		if(!isset($_GET['cat_id']) || empty($_GET['cat_id'])){//Comprobamos que exista el parámetro id, si no existe, se crea un array con un mensaje de error
			$response = array(
				'result' => 'error',
				'details' => 'Error en la solicitud'
			);

			Response::result(400, $response);
			exit;
		}
		// Verificar si hay artículos asociados a la categoría
		if ($categoria->hasAssociatedArticles($cat_id)) {
			$response = array(
				'result' => 'error',
				'details' => 'No se puede borrar la categoría, hay artículos asociados'
			);
	
			Response::result(400, $response);
			exit;
		}

		$categoria->delete($_GET['cat_id']);//Se llama al método delete() del modelo, pasándole como parámetro el id del jugador

		$response = array(
			'result' => 'ok'
		);//Se crea un array con el resultado de la petición

		Response::result(200, $response);//Se llama al método result de la clase Response, pasándole como parámetros el código de respuesta y el array con el resultado de la petición
		break;

	/**
	 * Para cualquier otro tipo de petición se devuelve un mensaje de error 404.
	 */
	default:
		$response = array(
			'result' => 'error'
		);

		Response::result(404, $response);

		break;

	}

?>