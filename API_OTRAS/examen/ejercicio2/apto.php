<?php
require_once 'src/response.php';
require_once 'src/classes/alumno.class.php';
require_once 'src/classes/auth.class.php';


$auth = new Authentication();
$auth->verify();

$alumno = new Alumno();





switch ($_SERVER['REQUEST_METHOD']) {
    case 'PUT':
		

		if(!isset($_GET['emp_id']) || empty($_GET['emp_id'])){
			$response = array(
				'result' => 'error no hay id',
				'details' => 'Error en la solicitud'
			);

			Response::result(400, $response);
			exit;
		}

		$alumno->apto($_GET['emp_id']);

		$response = array(
			'result' => 'ok'
		);

		Response::result(200, $response);	
		break;

        default:
		$response = array(
			'result' => 'error absoluto'
		);

		Response::result(404, $response);

		break;






}







?>