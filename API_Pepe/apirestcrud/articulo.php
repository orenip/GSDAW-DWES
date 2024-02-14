<?php
/**
 *	Script que se usa en los endpoints para trabajar con registros de la tabla ARTICULO
 *	La clase "articulo.class.php" es la clase del modelo, que representa una tipo de artículo
*/
require_once 'src/response.php';
require_once 'src/classes/articulo.class.php';

$articulo = new Articulo();

/**
 * Se mira el tipo de petición que ha llegado a la API y dependiendo de ello se realiza una u otra accción
 */
switch ($_SERVER['REQUEST_METHOD']) {
	/**
	 * Si se ha recibido un GET se llama al método get() del modelo y se le pasan los parámetros recibidos por GET en la petición
	 */
	case 'GET':
		$params = $_GET;

		$articulos = $articulo->get($params);

		$response = array(
			'result' => 'ok',
			'articulos' => $articulos
		);

		Response::result(200, $response);
		break;
		
	/**
	 * Si se recibe un POST, se comprueba si se han recibido parámetros y en caso afirmativo se usa el método insert() del modelo
	 */
	case 'POST':
		$params = json_decode(file_get_contents('php://input'), true);

		if(!isset($params)){
			$response = array(
				'result' => 'error',
				'details' => 'Error en la solicitud'
			);

			Response::result(400, $response);
			exit;
		}

		$insert_id = $articulo->insert($params);

		$response = array(
			'result' => 'ok',
			'insert_id' => $insert_id
		);

		Response::result(201, $response);
		break;

	/**
	 * Cuando es PUT, comprobamos si la petición lleva el id del jugador que hay que actualizar. En caso afirmativo se usa el método update() del modelo.
	 */
	case 'PUT':
		$params = json_decode(file_get_contents('php://input'), true);

		if(!isset($params) || !isset($_GET['art_id']) || empty($_GET['art_id'])){
			$response = array(
				'result' => 'error',
				'details' => 'Error en la solicitud'
			);

			Response::result(400, $response);
			exit;
		}

		$articulo->update($_GET['art_id'], $params);

		$response = array(
			'result' => 'ok'
		);

		Response::result(200, $response);
		break;

	/**
	 * Cuando se solicita un DELETE se comprueba que se envíe un id de jugador. En caso afirmativo se utiliza el método delete() del modelo.
	 */
	case 'DELETE':
    // Obtener el valor numérico al final de la URL
    $url = basename($_SERVER['REQUEST_URI']);
    $id = intval($url);

    // Verificar si se ha enviado un valor numérico
    if ($id > 0) {

      // Eliminar el registro mandado por url
      $articulo->delete($id);
    } else {
      if(!isset($_GET['art_id']) || empty($_GET['art_id'])){
        $response = array(
          'result' => 'error',
          'details' => 'Error en la solicitud, se deve indicar el parametro art_id en la peticion. '
        );
  
        Response::result(400, $response);
        exit;
      }

      // Eliminar el registro mandado por GET
      $articulo->delete($_GET['art_id']);
    }

		$response = array(
			'result' => 'ok'
		);

		Response::result(200, $response);
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