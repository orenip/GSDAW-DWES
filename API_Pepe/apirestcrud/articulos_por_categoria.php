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
    // Se comrpueba que se ha recibido el parámetro "categoria"
    if(!isset($_GET['categoria']) || empty($_GET['categoria'])){
			$response = array(
				'result' => 'error',
				'details' => 'Error en la solicitud, se deve indicar el parámetro categoria en la petición'
			);

			Response::result(400, $response);
			exit;
		}
 
    // Solamente usa el parámetro "categoria"
    $params = array(
      'art_categoria' => $_GET['categoria']
    );

    // Devuelve todos los articulos de la categoria indicada en el parámetro "categoria"
    $articulos = $articulo->get($params);
    $response = array(
      'result' => 'ok',
      'articulos' => $articulos
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